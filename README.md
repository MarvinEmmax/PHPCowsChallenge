# PHPCowsChallenge
# EJERCICIO 1 :
 SOLUCIÓN POR MARVIN EMMAX DEVELOPER. 10/2022.

Usted está intentando abrir negocio de producción de leche, para ello necesita comprar vacas, cuando va a elegir las vacas se cruza con un problema, tiene a su disposición un camión con un cierto límite de peso, y un grupo de vacas disponibles para la venta. Cada vaca puede tener un peso distinto, y producir una cantidad diferente de leche al día.

Su objetivo, es crear un programa que sea capaz de elegir automaticamente qué vacas comprar y llevar en su camión, de modo que pueda maximizar la producción de leche, sin sobrepasar el límite de peso del camión.

Al finalizar la ejecución debe mostrar la cantidad máxima de leche que puede producir con las vacas seleccionadas.


# Ejemplo 1 

Camión soporta 700 kg

Vaca   Peso en kilogramos	  Producción de leche por día
1	     360	                40
2	     250	                35
3	     400	                43
4	     180	                28
5	     50              	    12
6	     90              	    13

La mejor selección de vacas que podría cargar su camión seria 1, 4, 5 y 6 ya que estas 4 vacas pesan 680kg y darían el máximo de producción de leche posible el cual es 93 litros. 

Resultado:  93 litros.

# Caracteristicas

- El ejecicio fué realizado en PHP puro (Orientado a Objetos), sin frameworks ni librerias.
- El resultado muestra la mejor selección de vacas y también otras posibles combinaciones.


# Intrucciones

- El archivo exercise01.php contiene el programa para realizar este cálculo. Ejecutarlo desde el CLI.
- Sebe pasar como parametro el nombre del archivo de datos JSON y debe estar ubicado en el mismo directorio.
- Si no establece ningún archivo de datos se tomara por defecto el archivo "cows.json".

- Ejemplo:

  $ PHP exercise01.php "cows.json"

- Se incluyen tres archivos JSON con datos de ejemplo: cows.json, cows02.json, cows03,json
