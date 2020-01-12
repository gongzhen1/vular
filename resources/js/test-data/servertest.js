
const servertest = {
  "name": "VApp",
  "class": {
    "app": true
  },
  "style": {
    "background-color": "#f0f4f7"
  },
  "props": {
    "id": "layout",
    "light": true
  },
  "children": [
    {
      "name": "VularDrawer",
      "class": {
        "app--drawer": true
      },
      "style": {
        "overflow": "hidden"
      },
      "props": {
        "floating": true,
        "miniVariant": false,
        "app": true,
        "dark": true
      },
      "children": [
        {
          "name": "VularDrawerToolbar",
          "props": {
            "title": "Vular",
            "logo": "logo2.png",
            "showMiniButton": true,
            "dark": true,
            "href": "#",
            "drawerMini": false
          }
        },
        {
          "name": "div",
          "style": {
            "overflow": "auto",
            "height": "calc(100vh - 48px)"
          },
          "children": [
            {
              "name": "VList",
              "props": {
                "dense": true,
                "expand": true,
                "dark": true
              },
              "children": [
                {
                  "name": "VSubheader",
                  "children": [
                    {
                      "text": "系统设置"
                    }
                  ]
                },
                {
                  "name": "VDivider"
                },
                {
                  "name": "VListTile",
                  "props": {
                    "ripple": true,
                    "to": "xxxx",
                    "href": null
                  },
                  "children": [
                    {
                      "name": "VListTileAction",
                      "children": [
                        {
                          "name": "VIcon",
                          "children": [
                            {
                              "text": "edit"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTileContent",
                      "children": [
                        {
                          "name": "VListTileTitle",
                          "children": [
                            {
                              "text": "第二个 Menu"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTileAction",
                      "children": [
                        null
                      ]
                    }
                  ]
                },
                {
                  "name": "VListTile",
                  "props": {
                    "ripple": true,
                    "to": "xxxx2",
                    "href": null
                  },
                  "children": [
                    {
                      "name": "VListTileAction",
                      "children": [
                        {
                          "name": "VIcon",
                          "children": [
                            {
                              "text": "settings"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTileContent",
                      "children": [
                        {
                          "name": "VListTileTitle",
                          "children": [
                            {
                              "text": "第三个 Menu"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTileAction",
                      "children": [
                        {
                          "name": "VChip",
                          "props": {
                            "small": true,
                            "color": "red",
                            "textColor": "white"
                          },
                          "children": [
                            {
                              "text": "Hot"
                            }
                          ],
                          "style": {
                            "font-size": "10px",
                            "height": "12px"
                          }
                        }
                      ]
                    }
                  ]
                },
                {
                  "name": "VListTile",
                  "props": {
                    "ripple": true,
                    "to": {
                      "name": "adminpage",
                      "params": {
                        "pageid": "table"
                      }
                    },
                    "href": null
                  },
                  "children": [
                    {
                      "name": "VListTileAction",
                      "children": [
                        {
                          "name": "VBadge",
                          "children": [
                            {
                              "name": "Span",
                              "children": [
                                {
                                  "text": "3"
                                }
                              ],
                              "slot": "badge"
                            },
                            {
                              "name": "VIcon",
                              "children": [
                                {
                                  "text": "rowing"
                                }
                              ]
                            }
                          ],
                          "props": {
                            "color": "green"
                          }
                        }
                      ]
                    },
                    {
                      "name": "VListTileContent",
                      "children": [
                        {
                          "name": "VListTileTitle",
                          "children": [
                            {
                              "text": "Table"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTileAction",
                      "children": [
                        null
                      ]
                    }
                  ]
                },
                {
                  "name": "VListTile",
                  "props": {
                    "ripple": true,
                    "to": "xxxxx3",
                    "href": null
                  },
                  "children": [
                    {
                      "name": "VListTileAction",
                      "children": [
                        {
                          "name": "VBadge",
                          "children": [
                            {
                              "name": "Span",
                              "children": [
                                {
                                  "text": "5"
                                }
                              ],
                              "slot": "badge"
                            },
                            {
                              "name": "VIcon",
                              "children": [
                                {
                                  "text": "stars"
                                }
                              ]
                            }
                          ],
                          "props": {
                            "color": "yellow"
                          }
                        }
                      ]
                    },
                    {
                      "name": "VListTileContent",
                      "children": [
                        {
                          "name": "VListTileTitle",
                          "children": [
                            {
                              "text": "第四个 Menu"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTileAction",
                      "children": [
                        {
                          "name": "VChip",
                          "props": {
                            "small": true,
                            "color": "blue",
                            "textColor": "white"
                          },
                          "children": [
                            {
                              "text": "New"
                            }
                          ]
                        }
                      ]
                    }
                  ]
                },
                {
                  "name": "VDivider"
                },
                {
                  "name": "VSubheader",
                  "children": [
                    {
                      "text": "用户管理"
                    }
                  ]
                },
                {
                  "name": "VListGroup",
                  "props": {
                    "prependIcon": "account_box",
                    "subGroup": false
                  },
                  "children": [
                    {
                      "name": "VListTile",
                      "slot": "activator",
                      "children": [
                        {
                          "name": "VListTileContent",
                          "children": [
                            {
                              "name": "VListTileTitle",
                              "children": [
                                {
                                  "text": "管理员"
                                }
                              ]
                            }
                          ]
                        },
                        {
                          "name": "VListTileAction",
                          "children": [
                            {
                              "name": "VChip",
                              "props": {
                                "small": true,
                                "color": "green",
                                "textColor": "white"
                              },
                              "children": [
                                {
                                  "text": "哇"
                                }
                              ]
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListTile",
                      "props": {
                        "ripple": true,
                        "to": "xxxx55",
                        "href": null
                      },
                      "children": [
                        {
                          "name": "VListTileAction",
                          "children": [
                            {
                              "name": "VIcon"
                            }
                          ]
                        },
                        {
                          "name": "VListTileContent",
                          "children": [
                            {
                              "name": "VListTileTitle",
                              "children": [
                                {
                                  "text": "第三个 Menu"
                                }
                              ]
                            }
                          ]
                        },
                        {
                          "name": "VListTileAction",
                          "children": [
                            {
                              "name": "VChip",
                              "props": {
                                "small": true,
                                "color": "blue",
                                "textColor": "white"
                              },
                              "children": [
                                {
                                  "text": "cat"
                                }
                              ],
                              "style": {
                                "font-size": "10px"
                              }
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "name": "VListGroup",
                      "props": {
                        "prependIcon": null,
                        "subGroup": true
                      },
                      "children": [
                        {
                          "name": "VListTile",
                          "slot": "activator",
                          "children": [
                            {
                              "name": "VListTileContent",
                              "children": [
                                {
                                  "name": "VListTileTitle",
                                  "children": [
                                    {
                                      "text": "试试"
                                    }
                                  ]
                                }
                              ]
                            },
                            {
                              "name": "VListTileAction",
                              "children": [
                                null
                              ]
                            }
                          ]
                        },
                        {
                          "name": "VListTile",
                          "props": {
                            "ripple": true,
                            "to": null,
                            "href": null
                          },
                          "children": [
                            {
                              "name": "VListTileAction",
                              "children": [
                                {
                                  "name": "VIcon"
                                }
                              ]
                            },
                            {
                              "name": "VListTileContent",
                              "children": [
                                {
                                  "name": "VListTileTitle",
                                  "children": [
                                    {
                                      "text": "嵌套子菜单"
                                    }
                                  ]
                                }
                              ]
                            },
                            {
                              "name": "VListTileAction",
                              "children": [
                                null
                              ]
                            }
                          ]
                        }
                      ]
                    }
                  ]
                },
                {
                  "name": "VListGroup",
                  "props": {
                    "prependIcon": "account_circle",
                    "subGroup": false
                  },
                  "children": [
                    {
                      "name": "VListTile",
                      "slot": "activator",
                      "children": [
                        {
                          "name": "VListTileContent",
                          "children": [
                            {
                              "name": "VListTileTitle",
                              "children": [
                                {
                                  "text": "管理员2"
                                }
                              ]
                            }
                          ]
                        },
                        {
                          "name": "VListTileAction",
                          "children": [
                            null
                          ]
                        }
                      ]
                    }
                  ]
                }
              ]
            }
          ]
        }
      ]
    },
    {
      "name": "VToolbar",
      "props": {
        "app": true,
        "light": true
      },
      "children": [
        {
          "name": "VToolbarSideIcon",
          "on": {
            "click": {
              "event": "hideOrShowDrawer"
            }
          }
        },
        {
          "name": "VSpacer"
        }
      ]
    },
    {
      "name": "VContent",
      "children": [
        {
          "name": "VularPageLoadingProgressLinear",
          "props": {
            "height": 2,
            "indeterminate": true
          },
          "class": {
            "mt-0": true
          }
        },
        {
          "name": "transition",
          "children": [
            {
              "name": "keep-alive",
              "children": [
                {
                  "name": "router-view"
                }
              ]
            }
          ]
        }
      ]
    }
  ]
}

export default servertest;
