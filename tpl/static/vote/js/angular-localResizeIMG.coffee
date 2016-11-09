do ->
  app = angular.module 'localResizeIMG', []

  app.directive 'localResizeImg', ->
    return {
      restrict: 'A',
      scope:
        ngModel  : '='
        lWidth   : '='
        lQuality : '='
      link: (scope, element, attrs) ->
        convertImgToBase64 = (url, callback, outputFormat) ->
          canvas = document.createElement("CANVAS")
          ctx = canvas.getContext("2d")
          img = new Image
          img.crossOrigin = "Anonymous"
          img.onload = ->
            dataURL = undefined
            canvas.height = img.height
            canvas.width = img.width
            ctx.drawImage img, 0, 0
            dataURL = canvas.toDataURL(outputFormat)
            callback.call this, dataURL
            canvas = null

          img.src = url

        # 生成input
        file      = document.createElement 'input'
        file.type = 'file'

        # 生成功能
        $(file).localResizeIMG
          width  : scope.lWidth
          quality: scope.lQuality
          success: (result) ->
            scope.$apply ->
              scope.ngModel = result

        # 触发功能
        element.bind 'click', ->
            file.click()

        # model to view
        scope.$watch 'ngModel', (newVal) ->
          if typeof newVal isnt 'string'
            return false

          convertImgToBase64 newVal, (base64) ->
            scope.$apply ->
              scope.ngModel =
                base64     : base64
                clearBase64: base64.substr base64.indexOf(',') + 1

    }