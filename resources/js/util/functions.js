const functions = {
    urlencode (data, isPrefix) {
    isPrefix = isPrefix ? isPrefix : false
    let prefix = isPrefix ? '?' : ''
    let _result = []
    for (let key in data) {
      let value = data[key]
      if (['', undefined, null].includes(value)) {
         continue
      }
      _result.push(key + '=' + value)
    }
    return _result.length ? prefix + _result.join('&') : ''
  },
}

export default functions