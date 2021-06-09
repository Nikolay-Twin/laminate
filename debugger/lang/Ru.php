<?php
 
namespace Debug\Lang;

/** 
 * Класс En
 * 
 * NOTE: Requires PHP version 5.5 or later   
 * @author phpforum.su
 * @copyright © 2015
 * @license http://www.wtfpl.net/ Невозможно объявить класс ABC \ Core \ ActiveRecord \ Model, поскольку имя уже используется
 */   
class Ru
{

    const АCTION        = 'Локация -> действие';
    const FILE          = 'В файле';
    const LINE          = 'на линии';    
    const ARGUMENTS     = 'Аргументы';
    const STACK         = 'Стек';
    const DBG           = 'Вставить dbg()';
    const FIX           = 'Отремонтировать';
    const EDITOR        = 'Редактор';
    const TRACING_VAR   = 'Трассировка переменной';
    const TRACING_OBJ   = 'Трассировка  объекта';
    const COMMENT       = 'Закомментировать';
    const POSITION      = 'На позицию';
    
    protected static function errorReportings() 
    {
        return [
'Unsupported operand types' => 'Unsupported operand types<br /><span class="translate">

(Неподдерживаемые типы операторов)
</span><br />',    
        
        
'var_export does not handle circular references' => 'var_export() does not handle circular references<br /><span class="translate">

(var_export() не обрабатывает циклические ссылки)
</span><br />',    
        
'Getting unknown property:' => 'Getting unknown property<br /><span class="translate">

(Попытка получить неизвестное или приватное свойство)
</span><br />',
        
'Calling unknown method:' => 'Calling unknown method<br /><span class="translate">

(Вызов неизвестного или приватного метода)
</span><br />', 
        
'Syntax error.' => 'Syntax error.<br /><span class="translate">

(Синтаксическая ошибка)
</span><br />', 
        
'Dynamic class names are not allowed in compile-time' => 'Dynamic class names are not allowed in compile-time<br /><span class="translate">

(Динамические имена классов не допускаются во время компиляции)
</span><br />', 
        
'Argument (\d+) passed to (.+?) must be of the type (.+?), (.+?) given, ' => 'Argument $1 passed to $2 must be of the type $3, $4 given<br /><span class="translate">

(Аргументом $1, пришедшим в $2 должен быть ᐃ$3, оказалось ᐃ$4)
</span><br />', 

'Setting unknown property' => 'Setting unknown property<br /><span class="translate">

(Установка неизвестного свойства)
</span><br />',   

'Accessing static property (.+?) as non static' => 'Accessing static property $1 as non static<br /><span class="translate">

(Попытка доступа к статическому свойству $1 как к нестатическому)
</span><br />',    
        
'Call to private (.+?) from context (.+)' => 'Call to private $1 from context $2<br /><span class="translate">

(Обращение к приватному методу $1 из контекста $2)
</span><br />',

'Object of class Generator could not be converted to int' => 'Object of class Generator could not be converted to int <br /><span class="translate">

(Объект класса Generator не может быть преобразован в int)
</span><br />', 
        
'Cannot access empty property' => 'Cannot access empty property<br /><span class="translate">

(Не удается получить доступ к пустому свойству)

</span><br />', 
        
'Access level to (.+?) must be public \(as in class (.+?)\)' => 'Access level to $1 must be public (as in class $2)<br /><span class="translate">

(Уровень доступа к $1 должен быть общедоступным (как в классе $2))

</span><br />', 
        
'Cannot access  property (.+)' => 'Cannot access property $1<br /><span class="translate">

(Не удается получить доступ к свойству $1)

</span><br />', 
        
'Cannot declare class (.+?), because the name is already in use' => 'Cannot declare class $1, because the name is already in use<br /><span class="translate">

(Невозможно объявить класс $1, поскольку имя уже используется)

</span><br />', 
        
'Too few arguments to function (.+?), (\d+) passed in (.+?) on line (\d+) and exactly (\d+) expected' => 'Too few arguments to function $1, $2 passed in $3 on line $4 and exactly $5 expected<br /><span class="translate">

(Слишком мало аргументов для функции $1, в $3 в строке $4  передается $2, а ожидается точно $5)

</span><br />', 
        
'Attempt to assign property of non-object' => 'Attempt to assign property of non-object<br /><span class="translate">

(Попытка присвоить свойство не объекту)

</span><br />', 
'Cannot use (.+?) on the result of an expression \(you can use "null !== expression" instead\)' => 'Cannot use $1 on the result of an expression (you can use "null !== expression" instead)<br /><span class="translate">

(Невозможно использовать $1 в результате выражения (вместо этого вы можете использовать выражение "null !== expression))

</span><br />', 
        
'Argument (\d+) passed to .+?:(.+?) must be callable, (.+?) given, called in (.+)' => 'Argument $1 passed to :$2 must be callable, $3 given, called in $4 <br /><span class="translate">

(Аргумент $1 в :$2 должен быть валидным колбэком, передан $3)

</span><br />', 
        
'Cannot re-assign auto-global variable (.+)' => 'Cannot re-assign auto-global variable $1<br /><span class="translate">

(Невозможно повторно назначить автоматически-глобальную переменную $1)

</span><br />',
'Closure object cannot have properties' => 'Closure object cannot have properties<br /><span class="translate">

(Объект Closure не может иметь свойства)

</span><br />',
        
'Can\'t shift from an empty datastructure' => 'Can\'t shift from an empty datastructure<br /><span class="translate">

(Переход невозможен, так как структура данных пуста)

</span><br />',
        
'Function name must be a string' => 'Function name must be a string<br /><span class="translate">

(Имя функции должно быть строкой)

</span><br />',
'Multiple access type modifiers are not allowed' => 'Multiple access type modifiers are not allowed<br /><span class="translate">

(Модификаторы доступа не могут быть множемтвенного типа)

</span><br />',
'(.+?) method called on non-object' => '$1 method called on non-object<br /><span class="translate">

($1 метод вызывается не для объекта.)

</span><br />',
        
'(.+?): Cannot write property' => '$1: Cannot write property<br /><span class="translate">

($1: Невозможно записать свойство.)

</span><br />',
        
'(.+?): Number of variables doesn\'t match number of parameters in prepared statement' => '$1: Number of variables doesn\'t match number of parameters in prepared statement<br /><span class="translate">

($1: Число переменных не соответствует количеству параметров в подготовленном запросе.)

</span><br />',

'(.+?): Too few arguments' => '$1: Too few arguments<br /><span class="translate">

($1: Недостаточно аргументов.)

</span><br />',

'constant\(\): Couldn\'t find constant (.+)' => 'constant(): Couldn\'t find constant $1<br /><span class="translate">

(Невозможно найти константу $1)

</span><br />',
        
'Cannot use (.+) as (.+) because the name is already in use' => 'Cannot use $1 as $2 because the name is already in use<br /><span class="translate">

(Нельзя использовать $1, так как $2 уже используется)

</span><br />',
'call_user_func\(\) expects parameter (\d+) to be a valid callback, second array member is not a valid method' => 'call_user_func() expects parameter $1 to be a valid callback, second array member is not a valid method<br /><span class="translate">

(call_user_func() ожидает, что параметр $1 будет действительным обратным вызовом, но второй элемент массива не является допустимым методом)

</span><br />', 
        
'Argument (\d+) passed to (.+?) must be an instance of (.+?), instance of(.+?) given,' => 'Argument $1 passed to $2 must be an instance of $3, instance of $4 given<br /><span class="translate">

(Аргумент $1, переданный в $2, должен быть инстансом $3, а получен $4)

</span><br />',
'(.+?) Compilation failed: nothing to repeat at offset (\d+)' => '$1 Compilation failed: nothing to repeat at offset $2<br /><span class="translate">

($1 Сбой компиляции: ничего не повторяется при смещении $2)

</span><br />',
'(.+?) expects parameter (\d+) to be array, boolean given' => '$1 expects parameter $2 to be array, boolean given<br /><span class="translate">

($1 ожидает $2 параметром массив, а передано булево значение)

</span><br />',

'(.+?) expects parameter (\d+) to be a valid callback, function (.+?) not found or invalid function name' => '$1 expects parameter $2 to be a valid callback, function $3 not found or invalid function name<br /><span class="translate">

($1 ожидает $2 параметром валидный callback. Функция $3 не найдена, либо имеет неверное название)

</span><br />',

'Non-static method (.+?) should not be called statically' => 'Non-static method $1 should not be called statically<br /><span class="translate">

(Нестатический метод $1 не следует вызывать статично)

</span><br />',
'Uninitialized string offset: (\d+)' => 'Uninitialized string offset:$1<br /><span class="translate">

(Неинициализированное смещение строки $1)

</span><br />',
'(.+?) Both parameters should have an equal number of elements' => '$1 Both parameters should have an equal number of elements<br /><span class="translate">

($1: Оба параметра должны иметь равное количество элементов)

</span><br />',

'(.+?) Parameter (\d+) expected to be Array or Object.  Incorrect value given' =>  '$1: Parameter $2   expected to be Array or Object.  Incorrect value given<br /><span class="translate">

($1: Параметр $2 должен быть массивом или объектом. Передано некорректное значение)

</span><br />',
'(.+?): Requires argument (\d), (.+?), to be a valid callback' => '$1: Requires argument $2, $3, to be a valid callback<br /><span class="translate">

($1: Аргумент $2, $3, должен быть валидным callback.)

</span><br />',
        
'Cannot re-assign \$this' => 'Cannot re-assign $this<br /><span class="translate">

(Невозможно повторно назначить $this.)

</span><br />',
'Missing argument (\d+) for (.+?), called in (.+?) on line (.+?) and defined' => 'Missing argument $1 for $2, called in $3 on line $4 and defined<br /><span class="translate">

(Отсутствует аргумент $1 для $2 вызванного из $3 на линии $4.)

</span><br />',
        
'(.+?) and (.+?) define the same property (.+?) in the composition of (.+?). This might be incompatible, to improve maintainability consider using accessor methods in traits instead. Class was composed' => '$1 and $2 define the same property ($3) in the composition of $4. This might be incompatible, to improve maintainability consider using accessor methods in traits instead. Class was composed<br /><span class="translate">

$1 и $1 определяют одно и то же свойство ($3) в составе $4. Это может быть несовместимо. Для улучшения ремонтопригодности следует вместо этого использовать геттеры. Класс собран в

</span><br />',

'Illegal offset type' => 'Illegal offset type<br /><span class="translate">

(Недопустимый тип смещения.)

</span><br />',
'Call to a member function (.+?) on array' => 'Call to a member function $1 on array<br /><span class="translate">

(Вызов метода $1 из массива.)

</span><br />', 
'Argument (\d+) passed to (.+?) must be of the type (.+?), (.+?) given, called in (.+?) on line (.+?) and defined' => 'Argument $1 passed to $2 must be of the type $3, $4 given, called in $5 on line $6 and defined<br /><span class="translate">

(Аргумент $1, переданный в $2, должен быть $3, а определен как $4. Вызван в $5 на линии $6)

</span><br />', 
'Interface (.+?) not found' => 'Interface $1 not found<br /><span class="translate">

(Интерфейс $1 не найден.)

</span><br />', 
'(.+?): Argument (.+?) is not an array' => '$1: Argument $2 is not an array<br /><span class="translate">

($1 Аргумент $2 не массив.)

</span><br />',
'(.+?): Argument (.+?) should be an array' => '$1: Argument $2 should be an array<br /><span class="translate">

($1 Аргумент $2 должен быть массивом.)

</span><br />',
'Trait (.+?) not found' => 'Trait $1 not found<br /><span class="translate">

(Трэйт $1 не найден.)

</span><br />', 
'syntax error, unexpected end of file, expecting function \(T_FUNCTION\)' => 'Syntax error, unexpected end of file, expecting function<br /><span class="translate">

(Неожиданный конец файла, ожидается функция.)

</span><br />', 
'The magic method __call() must have public visibility and cannot be static' => 'The magic method __call() must have public visibility and cannot be statict<br /><span class="translate">

(Магический метод __call() должен быть публичным и не статичным.)

</span><br />', 


'(.+?) expects parameter (\d+) to be a valid callback, first array member is not a valid class name or object' => '$1 expects parameter (\d+) to be a valid callback, first array member is not a valid class name or object<br /><span class="translate">

($1 ожидает $2 параметром действующий callback-функционал, а первый элемент массива не является валидным именем класса или объектом.)

</span><br />', 
'(.+?) expects parameter (\d+) to be a valid callback, class (.+?) not found' => '$1 expects parameter $2 to be a valid callback, class $3 not found<br /><span class="translate">

($1 ожидает $2 параметром действующий callback-функционал, а класс $3 не найден.)

</span><br />', 
'The use statement with non-compound name \'(.+?)\' has no effect' => 'The use statement with non-compound name $1 has no effect<br /><span class="translate">

(Использование оператора use с несвязанным именем $1 не имеет эфекта.)

</span><br />', 
        
'(.+?) cannot use (.+?) - it is not a trait' => '$1 cannot use $2 - it is not a trait<br /><span class="translate">

($1 не может использовать $2 - это не трейт.)

</span><br />', 
'The magic method (.+?) must have public visibility and be static' => 'The magic method $1 must have public visibility and be static <br /><span class="translate">

(Магический метод $1 должен быть публичным и статичным.)

</span><br />', 
'Access to undeclared static property: (.+)' => 'Access to undeclared static property: $1<br /><span class="translate">

(Обращение к свойству, необъявленному статическим: $1)

</span><br />', 
'Declaration of (.+?) must be compatible with (.+)' => 'Declaration of $1 must be compatible with $2<br /><span class="translate">

(Объявление $1 должно быть совместимым с $2)

</span><br />',
        
'Class (.+?) contains (\d+) abstract methods and must therefore be declared abstract or implement the remaining methods (.+)' => 'Class $1 contains $2 abstract methods and must therefore be declared abstract or implement the remaining methods $3<br /><span class="translate">

(Класс $1 содержит  абстрактные методы ($2 шт) и поэтому должен быть объявлен абстрактным или реализовать остальные методы:<br />$3)

</span><br />',

'Using \$this when not in object context' => 'Using $this when not in object context<br /><span class="translate">

(Использование $this не в контексте объекта)

</span><br />',
        
'Class \'(.+?)\' not found' => 'Class $1 not found<br /><span class="translate">

(Класс $1 не найден)

</span><br />',
'Cannot redeclare (.+)' => 'Cannot redeclare $1<br /><span class="translate">

(Невозможно повторное объявление $1)

</span><br />',
        
'(.+)should return an array only containing the names of instance-variables to serialize' => '$1 should return an array only containing the names of instance-variables to serialize<br /><span class="translate">

(Serialize (): __sleep должен возвращать массив, содержащий только имена свойств для сериализации)

</span><br />',
'You cannot serialize or unserialize (.+?) instances' => 'You cannot serialize or unserialize $1 instances<br /><span class="translate">

(Вы не можете сериализовать и десереиализовать объекты $1)

</span><br />',
'Serialization of \'Closure\' is not allowed' => 'Serialization of \'Closure\' is not allowed<br /><span class="translate">

(Сериализация замыканий запрещена)

</span><br />',
'(.+?)Invalid arguments passed' => '$1Invalid arguments passed<br /><span class="translate">

($1 переданы недопустимые аргументы)

</span><br />', 
'Cannot access protected property (.+)' => 'Cannot access protected property  $1<br /><span class="translate">

(Нет доступа к защищенному свойству $1)

</span><br />',
'Missing argument (\d+) for (.+)' => 'Missing argument $1 for $2<br /><span class="translate">

(Отсутствует аргумент $1 для $2)

</span><br />',
'Maximum execution time of (.+?) seconds exceeded' => 'Maximum execution time of $1 seconds exceeded<br /><span class="translate">

(Превышено максимальное время выполнения $1 cекунд)

</span><br />',
        
'Cannot use (.+?) for reading' => 'Cannot use $1 for reading<br /><span class="translate">

(Нельзя использовать $1 при чтении)

</span><br />',
'Call to undefined function (.+)' => 'Call to undefined function $1<br /><span class="translate">

(Вызов неопределенной функции $1)

</span><br />',
        
'(.+?) operator not supported for strings' => '$1 operator not supported for strings<br /><span class="translate">

($1 оператор не поддерживается для строк)

</span><br />',
      
'(.*?)Unknown database(.+)' => 'Unknown database$2<br /><span class="translate">

(Неизвестная база данных$2)

</span><br />',
'syntax error, unexpected(.+)expecting(.+)or(.+)' => 'Synᐃtax error, unexpected$1expecting$2or$3<br /><span class="translate">

(Синтаксическая ошибка, неожиданное:$1, ожидалось $2ᐃ$3)

</span><br />',
'syntax error, unexpected (\'.+?\'), expecting end of file' => 'Syntax error, unexpected $1<br /><span class="translate">

(Синтаксическая ошибка, неожиданное: $1)

</span><br />',        
'syntax error, unexpected (\'.+?\')' => 'Syntax error, unexpected $1<br /><span class="translate">

(Синтаксическая ошибка, неожиданное: $1)

</span><br />', 
'Undefined variable: (.+)' => 'Undefined variable: $$1<br /><span class="translate">

(Не определена переменная: $$1)

</span><br />',
'Undefined property: (.+)' => 'Undefined property:$1<br /><span class="translate">

(Не определено свойство)

</span><br />',
'Undefined offset: (.+)' => 'Undefined offset: $1 <br /><span class="translate">

(Не определено смещение (номер элемента массива))

</span><br />',
'Undefined index: (.+)' => 'Undefined index: $1<br /><span class="translate">

(Не определен индекс массива)

</span><br />',
'Use of undefined constant(.*)' => 'Use of undefined constant <br /><span class="translate">

(Используется неопределенная константа)

</span><br />',
'Constant (.+?) already defined' => 'Constant $1 already defined<br /><span class="translate">

(Константа $1 уже определена)

</span><br />',
'(.+?)expects parameter (\d+?) to be a (.+?), no (.+?) or (.+?) given' => '$1 expects parameter $2 to be a $3, no $4 or $5 given <br /><span class="translate">

($1 ожидает, что $2-м параметром будет $3, а используется ᐃ$4 или ᐃ$5)

</span><br />',
'(.+?): Empty delimiter' => '$1: Empty delimiter <br /><span class="translate">

($1: отсутствует разделитель)

</span><br />',
'(.+?)expects exactly (\d+?) parameter[s]*, (\d+?) given' => '$1 expects exactly $2 parameters, $3 given <br /><span class="translate">

($1 ожидает  параметров: $2, а используется $3)

</span><br />',
'Declaration of (.+?) should be compatible with (.+)' => 'Declaration of $1 should be compatible with $2 <br /><span class="translate">

(Задекларированный $1 должен быть совместим с $2)

</span><br />',
'Missing argument (\d+?) for (.+?), called in (.+?) on line (\d+?) and defined' => 'Missing argument $1 for $2, called in $3 on line $4 and defined <br /><span class="translate">

(Отсутствует аргумент $1 для $2, вызванного из $3 на линии $4)

</span><br />',
'Invalid argument supplied for (.+)' => 'Invalid argument supplied for $1 <br /><span class="translate">

(Неверный аргумент передан в $1)

</span><br />',
'Division by zero' => 'Division by zero<br /><span class="translate">

(Деление на ноль)

</span><br />',
'Trying to get property of non-object' => 'Trying to get property of non-object<br /><span class="translate">

(Попытка получить свойство, не установленное в объекте)

</span><br />',
'Creating default object from empty value' => 'Creating default object from empty value<br /><span class="translate">

(Создание объекта из пустого значения)

</span><br />',
'Cannot modify header information - headers already sent by \(output started at(.+?)\)' => 'Cannot modify header information - headers already sent by (output started at $1)<br /><span class="translate">

(Не удается изменить информацию в заголовке - заголовки уже отправлены (отправка начата на $1))

</span><br />',
'Array to string conversion' => 'Array to string conversion<br /><span class="translate">

(Массив преобразуется в строку)

</span><br />',
'Call to a member function (.+?)on null'  => 'Call to a member function $1 on null<br /><span class="translate">

(Вызов метода $1 из NULL)

</span><br />',
'Call to undefined method (.+)'   => 'Call to undefined method: $1<br /><span class="translate">

(Вызов неопределенного метода)

</span><br />',
'Call to a member function (.+?) on boolean' => 'Call to a member function $1 on boolean<br /><span class="translate">

(Вызов метода $1 из булева значения)

</span><br />',
'Parameter (.+?) to (.+?) expected to be a reference, value given' => 'Parameter $1 to $2 expected to be a reference, value given<br /><span class="translate">

(Параметр $1 в $2 ожидался ссылкой, а задан значением)

</span><br />',
'Cannot pass parameter (.+?) by reference' => 'Cannot pass parameter $1 by reference<br /><span class="translate">

(Невозможно передать параметр $1 по ссылке)

</span><br />',
'Call-time pass-by-reference has been removed' => 'Call-time pass-by-reference has been removed<br /><span class="translate">

(Время передачи по ссылке было удалено)

</span><br />',
'Method (.+?) cannot take arguments by reference' => 'Method $1 cannot take arguments by reference<br /><span class="translate">

(Метод не может принимать аргументы по ссылке)

</span><br />',
'There is already an active transaction' => 'There is already an active transaction<br /><span class="translate">

(Уже есть активная транзакция)

</span><br />',
'There is no active transaction' => 'There is already an active transaction<br /><span class="translate">

(Нет активных транзакций)

</span><br />',
'Object of class (.+?) to string conversion' => 'Object of class $1 to string conversion<br /><span class="translate">

(Объект или класс $1 преобразуется в строку)

</span><br />',
'Object of class (.+?) could not be converted to string' => 'Object of class $1 could not be converted to string<br /><span class="translate">

(Объект или класс $1 нельзя преобразовать в строку)

</span><br />',
'Call to protected method (.+?) from context (.+)' => 'Call to protected method $1 from context $2<br /><span class="translate">

(Вызов защищенного метода $1 из контекста $2)

</span><br />',
'(.+?) expects at least (.+?) parameters, (.+?) given' => '$1 expects at least $2 parameters, $3 given<br /><span class="translate">

($1 ожидает как минимум параметров $2, а задано $3)

</span><br />',
'Call to a member function (.+?) on string' => 'Call to a member function $1 on string<br /><span class="translate">

(Вызов метода $1 из строки)

</span><br />',
'Undefined class constant (.+)' => 'Undefined class constant $1<br /><span class="translate">

(Не установлена константа $1 в классе)

</span><br />',
'Cannot use a scalar value as an array' => 'Cannot use a scalar value as an array<br /><span class="translate">

(Нельзя использовать скалярное значение в качестве массива

</span><br />',
'Invalid parameter number: Columns/Parameters are 1-based' => 'Invalid parameter number: Columns/Parameters are 1-based<br /><span class="translate">

(Неверный номер колонки/параметра. Отсчет должен начинаться с 1)

</span><br />',
'Illegal string offset (.+)' => 'Illegal string offset $1<br /><span class="translate">

(Недопустимое смещение, строкa $1)

</span><br />', 
'Cannot use object of type (.+?) as array' => 'Cannot use object of type $1 as array<br /><span class="translate">

(Невозможно использовать объект типа $1 как массив)

</span><br />',
'Call to a member function (.+?) on integer' => 'Call to a member function $1 on integer<br /><span class="translate">

(Вызов метода $1 из числа)

</span><br />',

// PDO

'.+Base table or view not found: 1146 Table (.+?) doesn\'t exist' => 'Base table or view not found: Table $1 doesn\'t exist<br /><span class="translate">

(Таблица $1 не обнаружена в базе данных)

</span><br />',
'.+Field (.+?) doesn\'t have a default value' => 'Field $1 doesn\'t have a default value<br /><span class="translate">

(Поле $1 не имеет значения по умолчанию)

</span><br />',
'PDO constructor was not called' => 'PDO constructor was not called<br /><span class="translate">

(Конструктор PDO не вызван)

</span><br />',

'.+You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near(.+?)at line (.+)' => 'You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near$1at line $2<br /><span class="translate">

(Ошибка SQL синтаксиса. <br />Обратитесь к мануалу, соответствующему Вашей версии MySQL сервера, чтобы использовать верно строку $1 на линии $2)

</span><br />',
'(.+?)SQLSTATE.+?General error' => '$1 General error<br /><span class="translate">

($1 Общая ошибка)

</span><br />',

                 //''  => '',
                 'Synᐃtax'  => 'Syntax',
                 'ᐃboolean' => 'boolean',
                 'ᐃnull'    => 'null',
                 'ᐃarray'   => 'массив',
                 'ᐃstring'  => 'строка',
                 'ᐃobject'  => 'объект',
                 'ᐃinteger' => 'число',
                 'ᐃ'        => 'или'
        ];
    }

    public static function translate($message) 
    {
        $reporting = self::errorReportings();
        $patterns = [];
     
        foreach ($reporting as $key => $value) {
            $patterns[] = '#'. $key .'#s';
        }
        return preg_replace($patterns, array_values($reporting), $message);
    }
}
