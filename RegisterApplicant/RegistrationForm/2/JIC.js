var jic = {
        /**
         * Receives an Image Object (can be JPG, PNG, or WEBP) and returns a new Image Object compressed
         * @param {Image} source_img_obj The source Image Object
         * @param {Integer} quality The output quality of Image Object
         * @param {String} output format. Possible values are jpg, png, and webp
         * @return {Image} result_image_obj The compressed Image Object
         */

        compress: function(source_img_obj, quality, output_format){
             
             var mime_type;
             if(output_format==="png"){
                mime_type = "image/png";
             } else if(output_format==="webp") {
                mime_type = "image/webp";
             } else {
                mime_type = "image/jpeg";
             }

             var cvs = document.createElement('canvas');
             cvs.width = source_img_obj.naturalWidth;
             cvs.height = source_img_obj.naturalHeight;
             var ctx = cvs.getContext("2d").drawImage(source_img_obj, 0, 0);
             var newImageData = cvs.toDataURL(mime_type, quality/100);
             var result_image_obj = new Image();
             result_image_obj.src = newImageData;
             return result_image_obj;
        },

        /**
         * Receives an Image Object and upload it to the server via ajax
         * @param {Image} compressed_img_obj The Compressed Image Object
         * @param {String} The server side url to send the POST request
         * @param {String} file_input_name The name of the input that the server will receive with the file
         * @param {String} filename The name of the file that will be sent to the server
         * @param {function} successCallback The callback to trigger when the upload is succesful.
         * @param {function} (OPTIONAL) errorCallback The callback to trigger when the upload failed.
	     * @param {function} (OPTIONAL) duringCallback The callback called to be notified about the image's upload progress.
	     * @param {Object} (OPTIONAL) customHeaders An object representing key-value  properties to inject to the request header.
         */

        upload: function(photo_comprsd_img, photo_name, photo_file_name, aadharf_comprsd_img, aadharf_name, aadharf_file_name, aadharb_comprsd_img, aadharb_name, aadharb_file_name, upload_url, successCallback, errorCallback, duringCallback, customHeaders){

            //ADD sendAsBinary compatibilty to older browsers
            if (XMLHttpRequest.prototype.sendAsBinary === undefined) {
                XMLHttpRequest.prototype.sendAsBinary = function(string) {
                    var bytes = Array.prototype.map.call(string, function(c) {
                        return c.charCodeAt(0) & 0xff;
                    });
                    this.send(new Uint8Array(bytes).buffer);
                };
            }

            var photo_type;
            if(photo_file_name.substr(-4).toLowerCase()===".png"){
                photo_type = "image/png";
            } else if(photo_file_name.substr(-5).toLowerCase()===".webp") {
                photo_type = "image/webp";
            } else {
                photo_type = "image/jpeg";
            }

            var aadharf_type;
            if(aadharf_file_name.substr(-4).toLowerCase()===".png"){
                aadharf_type = "image/png";
            } else if(aadharf_file_name.substr(-5).toLowerCase()===".webp") {
                aadharf_type = "image/webp";
            } else {
                aadharf_type = "image/jpeg";
            }

            var aadharb_type;
            if(aadharb_file_name.substr(-4).toLowerCase()===".png"){
                aadharb_type = "image/png";
            } else if(aadharb_file_name.substr(-5).toLowerCase()===".webp") {
                aadharb_type = "image/webp";
            } else {
                aadharb_type = "image/jpeg";
            }

            var photo_data = photo_comprsd_img.src;
            photo_data = photo_data.replace('data:' + photo_type + ';base64,', '');

            var aadharf_data = aadharf_comprsd_img.src;
            aadharf_data = aadharf_data.replace('data:' + aadharf_type + ';base64,', '');

            var aadharb_data = aadharb_comprsd_img.src;
            aadharb_data = aadharb_data.replace('data:' + aadharb_type + ';base64,', '');

            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', upload_url, true);
            var boundary = 'someboundary';

            xhr.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
		
    		// Set custom request headers if customHeaders parameter is provided
    		if (customHeaders && typeof customHeaders === "object") {
    			for (var headerKey in customHeaders){
    				xhr.setRequestHeader(headerKey, customHeaders[headerKey]);
    			}
    		}
    		
    		// If a duringCallback function is set as a parameter, call that to notify about the upload progress
    		if (duringCallback && duringCallback instanceof Function) {
    			xhr.upload.onprogress = function (evt) {
    				if (evt.lengthComputable) {  
    					duringCallback ((evt.loaded / evt.total)*100);  
    				}
    			};
    		}

            var fdImg1=['--' + boundary, 'Content-Disposition: form-data; name="' + photo_name + '"; filename="' + photo_file_name + '"', 'Content-Type: ' + photo_type, '', atob(photo_data),'--' + boundary];
            var fdImg2=['Content-Disposition: form-data; name="'+aadharf_name+'"; filename="' + aadharf_file_name + '"', 'Content-Type: ' + aadharf_type, '', atob(aadharf_data), '--' + boundary ];
            var fdImg3=['Content-Disposition: form-data; name="'+aadharb_name+'"; filename="' + aadharb_file_name + '"', 'Content-Type: ' + aadharb_type, '', atob(aadharb_data), '--' + boundary + '--'];
            
            // var fdMerged = fdImg1.concat(fdImg2);
            var fdMerged = [];
            fdMerged.push.apply(fdMerged, fdImg1);
            fdMerged.push.apply(fdMerged, fdImg2);
            fdMerged.push.apply(fdMerged, fdImg3);

            var formData=fdMerged.join('\r\n');
		  
            xhr.sendAsBinary(formData);
            
            xhr.onreadystatechange = function() {
    			if (this.readyState == 4){
    				if (this.status == 200) {
    					successCallback(this.responseText);
    				}else if (this.status >= 400) {
    					if (errorCallback &&  errorCallback instanceof Function) {
    						errorCallback(this.responseText);
    					}
    				}
    			}
            };


        }
};