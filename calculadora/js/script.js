document.addEventListener('DOMContentLoaded', function() {
    const resultDisplay = document.getElementById('result');
    const historyDisplay = document.getElementById('history');
    let operation = '';  
    let history = '';    
    let lastResult = ''; 
    const maxDecimals = 10; 

    // Conversión de grados a radianes
    function toRadians(degrees) {
        return degrees * (Math.PI / 180);
    }

    // Función para calcular el factorial
    function factorial(n) {
        return n === 0 || n === 1 ? 1 : n * factorial(n - 1);
    }

    // Función para cerrar paréntesis faltantes
    function closeParentesis(expression) {
        const openCount = (expression.match(/\(/g) || []).length;
        const closeCount = (expression.match(/\)/g) || []).length;
        const unclosed = openCount - closeCount;

        // Agregar los paréntesis de cierre que falten
        if (unclosed > 0) {
            expression += ')'.repeat(unclosed);
        }
        return expression;
    }

    // Función para insertar multiplicación implícita cuando se detectan ciertos patrones
    function addMultiplication(expression) {
        // Evitar inserción de multiplicación en notación científica (e.g., 7.389e+28)
        return expression
            .replace(/(\d)(sin|cos|tan|log|ln|√|π|e(?![+\-]?\d))/g, '$1*$2') // No poner * después de e+ o e-
            .replace(/(\))(\d|sin|cos|tan|log|ln|√|π|e(?![+\-]?\d))/g, '$1*$2');
    }

    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const value = this.textContent;

            if (value === 'AC') {
                operation = '';
                resultDisplay.textContent = '';  
                historyDisplay.textContent = '';
            } else if (value === '⌫') {
                operation = operation.slice(0, -1);
                resultDisplay.textContent = operation;
            } else if (value === '=') {
                try {
                    // Cerrar paréntesis faltantes
                    operation = closeParentesis(operation);

                    // Agregar multiplicación implícita donde sea necesario
                    operation = addMultiplication(operation);

                    // Reemplazar funciones amigables por funciones de JavaScript
                    let parsedOperation = operation.replace(/×/g, '*')
                                                   .replace(/÷/g, '/')
                                                   .replace(/sin\(/g, 'toRadiansAndSin(')
                                                   .replace(/cos\(/g, 'toRadiansAndCos(')
                                                   .replace(/tan\(/g, 'toRadiansAndTan(')
                                                   .replace(/log\(/g, 'Math.log10(')
                                                   .replace(/ln\(/g, 'Math.log(')
                                                   .replace(/π/g, 'Math.PI')
                                                   .replace(/√/g, 'Math.sqrt')
                                                   .replace(/\^/g, '**')
                                                   // Reemplazar "e" por "Math.E" solo si no está en notación científica (e.g., e+10)
                                                   .replace(/\be(?![+\-]?\d)/g, 'Math.E'); 

                    // Reemplazo específico para factorials
                    parsedOperation = parsedOperation.replace(/(\d+)!/g, function(match, number) {
                        return factorial(parseInt(number));
                    });

                    let result = eval(parsedOperation);

                    if (result % 1 !== 0) {
                        result = parseFloat(result.toFixed(maxDecimals));  
                    }

                    history = operation;  
                    historyDisplay.textContent = history;  
                    resultDisplay.textContent = result;  
                    operation = result.toString();  
                    lastResult = result;  

                } catch (error) {
                    resultDisplay.textContent = 'Error';
                }
            } else if (value === 'Ans') {
                operation += lastResult;  
                resultDisplay.textContent = operation;
            } else if (value === 'sin') {
                operation += `sin(`;
                resultDisplay.textContent = operation;
            } else if (value === 'cos') {
                operation += `cos(`;
                resultDisplay.textContent = operation;
            } else if (value === 'tan') {
                operation += `tan(`;
                resultDisplay.textContent = operation;
            } else if (value === 'log') {
                operation += `log(`;
                resultDisplay.textContent = operation;
            } else if (value === 'ln') {
                operation += `ln(`;
                resultDisplay.textContent = operation;
            } else if (value === '!') {
                // Añadir el símbolo de factorial a la operación
                operation += `!`;
                resultDisplay.textContent = operation;
            } else if (value === '√') {
                operation += `√`;  // Permitir escribir √ y luego el número
                resultDisplay.textContent = operation;
            } else {
                operation += value;
                resultDisplay.textContent = operation;
            }
        });
    });

    // Funciones trigonométricas con conversión a radianes
    function toRadiansAndSin(value) {
        return Math.sin(toRadians(value));
    }

    function toRadiansAndCos(value) {
        return Math.cos(toRadians(value));
    }

    function toRadiansAndTan(value) {
        return Math.tan(toRadians(value));
    }
    
    // Cambiar entre modo básico y científico con las imágenes
    document.getElementById('toggle-scientific').addEventListener('click', function() {
        const scientificButtons = document.querySelectorAll('.scientific-only');
        const toggleImage = document.getElementById('toggle-image');

        scientificButtons.forEach(button => {
            button.classList.toggle('hidden');
        });

        // Cambiar la imagen del botón al hacer clic
        if (toggleImage.src.includes("basica.png")) {
            toggleImage.src = "images/cientifica.png";
        } else {
            toggleImage.src = "images/basica.png";
        }
    });
});
