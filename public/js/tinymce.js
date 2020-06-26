function edit_img(title, alternate, align, file_path) {
    file = decodeURIComponent(file);
    //To get image name from image_path
    file_arr = file.split('/');
    file = file_arr[file_arr.length-1];
    //Checking image inside tinymce and changing its edited attributes
    tinymce.activeEditor.$("img[src$='"+file+"']").attr({'alt' : alternate , 'align' : align , 'title' : title});
}

function getAttrFromString(str, node, attr) {
    var regex = new RegExp('<' + node + ' .*?' + attr + '="(.*?)"', "gi"), result, res = [];
    while ((result = regex.exec(str))) {
        res.push(result[1]);
    }
    return res;
}

var arrayOfImageSrcs = getAttrFromString(
    '<img src="http://placekitten.com/350/300"><img src="http://placekitten.com/350/300">',
    'img',
    'src'
);

function uploadImages() {
    var content = tinymce.get("#textarea").getContent();
    console.log(content);

}
