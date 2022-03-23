export default {
    config: {
        // classes: {
        //     label: 'control-label fw-bold',
        //     input: 'form-control fw-bold',
        // }
    },
    messages: {
        en: {
            validation: {
                required() {
                    return 'Това поле е задължително';
                },
                max({args}) {
                    return `Стойността на това поле трябва да бъде по-малко от ${args[0]}`;
                },
                min({args}) {
                    return `Стойността на това поле трябва да бъде по-голяма от ${args[0]}`;
                },
                number() {
                    return 'Това поле трябва да съдържа само цифри';
                },
                length({args}) {
                    return `Това поле трябва да е дължина между ${args[0]} и ${args[1]} символа`;
                }
            }
        }
    }
}
