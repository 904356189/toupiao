    /**
     * ���base64
     * @param {Object} obj
     * @param {Number} [obj.width] ͼƬ��Ҫѹ���Ŀ�ȣ��߶Ȼ�������
     * @param {Number} [obj.quality=0.8] ѹ����������ѹ��Ϊ1
     * @param {Function} [obj.before(this, blob, file)] ����ǰ����,thisָ�����input:file
     * @param {Function} obj.success(obj) �������
     * @example
     *
     */
    $.fn.localResizeIMG = function(obj) {
        this.on('change', function() {
            var file = this.files[0];
            var URL = window.URL || window.webkitURL;
            var blob = URL.createObjectURL(file);

            // ִ��ǰ����
            if ($.isFunction(obj.before)) {
                obj.before(this, blob, file)
            };

            _create(blob, file);
            this.value = ''; // �����ʱ����
        });

        /**
         * ����base64
         * @param blob ͨ��file��õĶ�����
         */
        function _create(blob) {
            var img = new Image();
            img.src = blob;

            img.onload = function() {
                var that = this;

                //���ɱ���
                var w = that.width,
                    h = that.height,
                    scale = w / h;
                w = obj.width || w;
                h = w / scale;

                //����canvas
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                $(canvas).attr({
                    width: w,
                    height: h
                });
                ctx.drawImage(that, 0, 0, w, h);

                /**
                 * ����base64
                 * �����޸��ƶ��豸��Ҫ����mobileBUGFix.js
                 */
                var base64 = canvas.toDataURL('image/jpeg', obj.quality || 0.8);

                // �޸�IOS
                if (navigator.userAgent.match(/iphone/i)) {
                    var mpImg = new MegaPixImage(img);
                    mpImg.render(canvas, {
                        maxWidth: w,
                        maxHeight: h,
                        quality: obj.quality || 0.8
                    });
                    base64 = canvas.toDataURL('image/jpeg', obj.quality || 0.8);
                }

                // �޸�android
                if (navigator.userAgent.match(/Android/i)) {
                    var encoder = new JPEGEncoder();
                    base64 = encoder.encode(ctx.getImageData(0, 0, w, h), obj.quality * 100 || 80);
                }

                // ���ɽ��
                var result = {
                    base64: base64,
                    clearBase64: base64.substr(base64.indexOf(',') + 1)
                };

                // ִ�к���
                obj.success(result);
            };
        }
    };


    // ����
    /*
    $('input:file').localResizeIMG({
        width: 100,
        quality: 0.1,
        //before: function (that, blob) {},
        success: function (result) {
            var img = new Image();
            img.src = result.base64;

            $('body').append(img);
            console.log(result);
        }
    });
*/