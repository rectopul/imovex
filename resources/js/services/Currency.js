
const Currency = {

    prefix: 'R$',

    stringToNumber(string) {

        if (string) {
            string = string.trim();
            string = string.replace(this.prefix, '');
            string = string.replace(',', '');
            string = string.replace('.', '');
        }

        return Number(string);
    }   

}

export default Currency