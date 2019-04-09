# DataAccessObject-PDO

Simples exemplo que descreve uma classe DAO (Data Access Object) utilizando PDO do php.


### Create Procedure in MySql

```sql
DELIMITER //
	CREATE PROCEDURE `sp_users_insert` (
		pname varchar(50),
		plogin varchar(50),
		ppassword varchar(256)
	)
	BEGIN
		INSERT INTO users (name, login, password) VALUES (pname, plogin, ppassword);

		SELECT * FROM users WHERE userID = LAST_INSERT_ID();
	END
DELIMITER ;
//
```