const letrasNumEspacio = new RegExp(/^[\wáéíóúüÑÁÉÍÓÚñ\-\s]+$/ );
const validaUrl = new RegExp(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/ );
const imgFormat=new RegExp(/\.(jpg|png|gif)$/i);
const soloNum=new RegExp(/^[0-9]+$/);
//k
const sololetras = new RegExp(/^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/);

const numDecimal=new RegExp(/^(0|[1-9]\d*)(\.\d+)?$/ );
const alphareg = /^[A-Za-z]*\s()[A-Za-z]*$/g;
const emailreg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const expUsername=/^[a-z0-9ü][a-z0-9ü_]{3,15}$/;
const regexp_password = /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{6,16}$/;
const regexobj=/^[a-zA-Z0-9üáéíóú][a-zA-Z0-9ü+ _áéíóú-]{3,30}$/;
const regexobjPrepare=/^[a-zA-Z0-9üÑÁÉÍÓÚáéíóú\r\n][a-zA-Z0-9ü+ _.,:;ÑÁÉÍÓÚáéíñóú@\r\n-]{3,1900}$/;