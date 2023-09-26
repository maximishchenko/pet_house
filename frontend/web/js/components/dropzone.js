import { create, registerPlugin } from 'filepond';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

registerPlugin(FilePondPluginFileValidateType);
registerPlugin(FilePondPluginFileValidateSize);

const input = document.querySelector('.personal-file-inp');
create(input, {
    storeAsFile: true,
    acceptedFileTypes: ['image/*'],
    labelIdle: '<span class="filepond--label-action">Выберите файл до 5MB</span>',
    maxFileSize: '5mb',
    labelFileTypeNotAllowed: 'Файл недопустимого типа',
    fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',
    labelMaxFileSizeExceeded: 'Файл слишком большой',
    labelMaxFileSize: 'Максимальный размер файла  {filesize}',
    labelMaxTotalFileSizeExceeded: 'Maximum total size exceeded',
    labelMaxTotalFileSize: 'Maximum total file size is {filesize}',
});