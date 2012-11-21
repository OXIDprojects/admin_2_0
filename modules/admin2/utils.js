var admin2 = {
    charPool      :[
        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9
    ],
    generateString:function (length) {
        if (!length) {
            length = 8;
        }

        var poolIndex, result = '';

        for (var i = 0; i < length; i++) {
            poolIndex = Math.floor(1 + Math.random() * this.charPool.length);
            result += this.charPool[poolIndex];
        }

        return result;
    },
    setInputValue:function(inputId, value) {
        document.getElementById(inputId).value = value;
    },
    setInputType:function(inputId, newType) {
        document.getElementById(inputId).setAttribute('type', newType);
    }
};
