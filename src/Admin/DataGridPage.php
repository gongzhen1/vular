<?php
namespace Water\Vular\Admin;

use Water\Vular\Admin\Page;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Html\Div;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VCardTitle;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vular\VularDataTable;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\Vular\VularTablePagination;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularTableColumn;
//use Log;

abstract class DataGridPage extends Page{

    protected $viewModel;
    protected $editPage;
    protected $vularDataTable;
    protected $batchMenu;
    protected $batchMenuList;
    protected $modelClass;
    private $filter;

    public function __construct($vularId = null, $viewModel = null){
        parent::__construct($vularId);
        $this->columns = $this->showColumns();
        $this->vularDataTable = VularDataTable::make()
            ->selectAll()
            ->noResultsText('')
            ->bindsToPage($this)
            ->columns(
                $this->columns,
                VularTableColumn::make('actions', trans('vular.operate'))
                //->class('text-xs-right')
            )
            //->viewModel(new \stdClass)
            ;
        $this->batchMenu = BatchMenu::make($this->vularDataTable);
    }

    abstract function columns();
    function editPage(){
        return null;
    }

    function showColumns(){
        return array_filter($this->columns(),function($column){
            return !$column->isHidden();

        });
    }

    function batchMenu(){
        return $this->batchMenu;
    }

    function filter($filter){
        $this->filter = $filter;
        $this->filter->bindsTo($this->vularDataTable);
        return $this;
    }


    function makeUI(){
        //$this->getTableData();
        $newBtn = null;
        if($this->editPage()){
            $newBtn = VBtn::make()
                        ->round()
                        ->large()
                        ->color('primary')
                        ->dark()
                        ->class('mb-2')
                        ->children(
                            VIcon::make('add')
                                ->left()
                                ->dark()
                        )
                        ->text(trans('vular.add-new'))
                        ->click(
                            $this->editPage()->toMeAction()
                        );
            
        }
        $this->children(
                $this->breadcrumbs,
                VLayout::make()
                    ->class('pb-2 align-center')
                    ->row()
                    ->wrap()
                    ->children(
                        VularNode::make()->becomeTo('h3')
                        ->text($this->title),
                        VSpacer::make(),
                        $newBtn
                    ),
                $this->vularDataTable
                    ->children(
                        VCardTitle::make()
                            ->slot('header')
                            ->class('pa-1')
                            ->children(
                                $this->batchMenu->toVular(),
                                Div::make()
                                    ->style('width','300px')
                                    ->class('ml-4')
                                    ->children(
                                        VTextField::make()
                                            ->field('keywords')
                                            ->type('search')
                                            ->on('keyup',['keycode'=>13])
                                            ->appendIcon('search')
                                            ->placeholder(trans('vular.search') .'...')
                                            //->autofocus()
                                            ->bindsTo($this->vularDataTable)
                                            ->keyup(
                                                VularAction::make()
                                                    ->action('reload')
                                                    ->keyCode(13)
                                                    ->post()
                                                    ->bindsTo($this->vularDataTable)
                                            )
                                    ),
                                VSpacer::make(),

                                $this->filter?$this->filter->toVular():null
                            )
                    )                       
        );

        return $this;
    }



    function delete($viewModel){
        $modelClass = $this->modelClass();
        $this->beforeDelete([$viewModel->params->id]);
        $modelClass::destroy($viewModel->params->id);
        return $this->fetch($viewModel); 
    }

    function beforeDelete($ids){

    }

    function batchDelete($viewModel){
        $modelClass = $this->modelClass();
        //Log::notice($viewModel->selected);
        $this->beforeDelete($viewModel->selected);
        $modelClass::destroy($viewModel->selected);
        //$this->model->selected = [];
        return $this->fetch($viewModel); 
    }

    function setModelClass($modelClass){
        $this->modelClass = $modelClass;
    }

    function modelClass(){
        if($this->modelClass) return $this->modelClass;

        return $this->editPage()->modelClass();
    }

    /**
     * Create a new invokable filter applier.
     *
     * @param  \stdClass  $viewModel
     *         $viewModel->keywords 查询关键词
     *         $viewModel->pagination->rowsPerPage 每页显示的记录数
     *         $viewModel->pagination->sortBy 排序的字段
     *         $viewModel->filters 过滤器，键值对形式
     * @param  mixed  $value
     * @return rows data
     */
    function fetch($viewModel){
        //Log::notice($this->model->keywords);
        $keywords = trim($viewModel->keywords);
        $pagination = $viewModel->pagination;
        $rowsPerPage = $pagination->rowsPerPage;
        $query = $this->queryBuilder();

        $query = $query->where( function($query) use ($keywords){
            if($keywords){
                //Log::notice($keywords);
                foreach ($this->columns as $i => $column) {
                    if($column->searchable){
                        $query = $i == 0 ? $query->where($column->field, 'like', '%' .$keywords. '%')
                               : $query->orWhere($column->field, 'like', '%' .$keywords. '%');
                    }
                }
            }
        });
        if(property_exists($viewModel,'filters')){
            $query = $query->where($this->filter->toExpressions($viewModel->filters));
        }
        //$this->appendFilters($viewModel, $query);
        $this->query($query);

        if($pagination->sortBy){

           $query = $query->orderBy($pagination->sortBy, $pagination->descending ? 'desc' : 'asc');
        }

        $query = $this->appendToQuery( $query);

        $rows = $rowsPerPage == -1 ? $query->all() : $query->paginate($rowsPerPage );
        $this->letRowsForView($rows);
        return $rows;
    }


    function queryBuilder(){
        $modelClass = $this->modelClass();
        return  new $modelClass();
    }

    function appendToQuery($queryBuilder){
        return $queryBuilder;
    }

    /*function appendFilters($model,&$query){
        if(!$model->filters){
            return;
        }
        foreach ($model->filters as $key => $value) {
            
        }
    }*/

    function letRowsForView($rows){
        foreach ($rows as $row) {
            $this->fillRelationField($row);
            $this->onRow($row);
        }
    }

    function onRow($row){
        $actionButtons = [
                $this->makeRowEditAction($row),
                $this->makeRowDeleteAction($row)
            ];
        $actionButtons = $this->rowActionButtons($actionButtons, $row);
        $row->actions = VularNode::make()
            //->class('text-xs-right')
            ->children(
                $actionButtons
            )
            ->removeHidden();
        //\Log::notice(json_encode($row->actions));
    }

    function rowActionButtons($buttonArray, $row){
        return $buttonArray;
    }

    function fillRelationField($row){
        foreach ($this->columns as $column) {
            $fieldName = $column->field;
            $nameParts = explode(".", $fieldName);
            if(!$row->$fieldName && count($nameParts)>1){
                //\Log::notice($nameParts);
                $relationName = $nameParts[0];
                $relationField = $nameParts[1];
                $row->$fieldName = $row->$relationName ? $row->$relationName->$relationField : '';
                //\Log::notice($fieldCode);
                //eval($fieldCode);
            }
        }
            
    }

    function makeRowEditAction($row){
       return $this->rowEditButton(VBtn::make()
            ->class('ma-0')
            ->style('width:26px;height:26px;')
            ->flat()
            ->icon()
            ->small()
            ->color('#757575')
            ->children(
                VIcon::make('edit')
                    ->small()
            )
            ->click($this->editPage()?$this->editPage()
                ->toMeAction()
                ->param('id', $row->id):null
            ),
            $row
        );
    }

    function rowEditButton($btn, $row){
        return $btn;
    }

    function makeRowDeleteAction($row){
        return $this->rowDeleteButton(VBtn::make()
            ->class('ma-0')
            ->style('width:26px;height:26px;')
            ->flat()
            ->icon()
            ->small()
            ->color('#757575')
            ->children(
                VIcon::make('delete')
                    ->small()
            )
            ->click(
                VularAction::make()
                    ->action('delete')
                    ->post()
                    ->confirm(trans('vular.confirm-delete'))
                    ->bindsTo($this->vularDataTable)
                    ->param('id', $row->id)
            ),
            $row
        );
    }

    function rowDeleteButton($btn, $row){
        return $btn;
    }

    function query(&$query){
        return $query;
    }

}