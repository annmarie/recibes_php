FN=/var/www/dev/db/mysql/init.sql

if [ ! -z `ls $FN` ]; then
    # Create a database with that name
    mysqladmin -u root -proot -f drop recibes
    mysqladmin -u root -proot create recibes

    # Import the SQL into new database
    mysql -u root -f -proot recibes < $FN
fi

