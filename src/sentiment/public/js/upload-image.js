const upfiles = Array.from(document.getElementsByClassName('fileInput'));
const base64Upfiles = Array.from(document.getElementsByClassName('base64Upfile'));

const changeLabel = (fileNameId, fileName) => {
    const label = document.getElementById(`span_${fileNameId}`)
    label.innerText = fileName
}

function blobToBase64(blob) {
    return new Promise((resolve, _) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.readAsDataURL(blob);
    });
}

const compressImage = (e, upfile) => {
    const upfileId = upfile.id
    const imageFile = e.target.files[0];
    const options = {
        maxSizeMB: 1,
        maxWidthOrHeight: 1024
    }
    imageCompression.getDataUrlFromFile(imageFile, options)
    imageCompression(imageFile, options)
        .then(async function (compressedFile) {
            const uploadDataurl = document.getElementById(`base64_${upfileId}`);
            uploadDataurl.value = await blobToBase64(compressedFile);
            changeLabel(upfileId, imageFile.name)
        })
        .catch(function (error) {
            alert('イメージの圧縮に失敗しました。')
        });
}

upfiles.forEach(upfile => {
    upfile.addEventListener("change", (e) => {
        compressImage(e, upfile);
    }, false);
});

window.addEventListener('load', () => {
    base64Upfiles.forEach(base64Upfile => {
        base64Upfile.value = '';
    });
})
