Para habilitar la extensión intl en PHP a través del archivo php.ini, sigue estos pasos:

Habilitar la Extensión intl en php.ini
Localiza el archivo php.ini:

La ubicación de este archivo puede variar según el sistema operativo y cómo se instaló PHP. Aquí hay algunas ubicaciones comunes:
Windows: C:\xampp\php\php.ini (si usas XAMPP) o C:\wamp64\bin\php\phpX.X.X\php.ini (si usas WAMP).
Linux: Generalmente se encuentra en /etc/php/X.X/apache2/php.ini o /etc/php/X.X/cli/php.ini, donde X.X es la versión de PHP.
macOS: Puede estar en /usr/local/etc/php/X.X/php.ini.
Edita el archivo php.ini:

Abre el archivo php.ini en un editor de texto con privilegios de administrador (por ejemplo, nano, vim, o un editor de texto en Windows).
Busca la línea para la extensión intl:

Busca la línea que dice ;extension=intl (el punto y coma al inicio indica que está comentada).
Descomentar la línea:

Elimina el punto y coma (;) al inicio de la línea, de modo que se vea así:

ini
Copiar código
extension=intl
Guarda los cambios:

Guarda el archivo después de realizar el cambio.
Reinicia el servidor web


123 -> siento tres 