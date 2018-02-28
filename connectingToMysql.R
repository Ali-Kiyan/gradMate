library(RMySQL)
library(dbConnect)
con = dbConnect(MySQL(), user='root', password='root', dbname='fromR', host='localhost',unix.sock="/Applications/MAMP/tmp/mysql/mysql.sock")
dbListTables(con)
