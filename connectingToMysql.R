library(RMySQL)
library(dbConnect)
library(party)
library(ggplot2)
library(psych)  
con = dbConnect(MySQL(), user='root', password='root', dbname='jobWizard', host='localhost',unix.sock="/Applications/MAMP/tmp/mysql/mysql.sock")
dbListTables(con)
str(con)
query <- "SELECT * FROM company"
industry <- "SELECT DISTINCT industry FROM company"
industryCompany <- "select * from company where `industry` in (SELECT DISTINCT `industry` FROM company WHERE industry !='Other');"
result <- dbGetQuery(con, query)
industry <- dbGetQuery(con, industry)
industryCompany <- dbGetQuery(con, industryCompany)
str(result)
result <- as.data.frame(result)
industryCompany <- as.data.frame(industryCompany)
r <- industryCompany
typeof(result)
#sectors <- result$industry[!grepl("Other", result$industry)]
#sectors <- as.data.frame(sectors)
# unique first column
#sectors <- unique( sectors[ ,1] )
#sectors <- as.data.frame(sectors)
#discovering data
pairs.panels(result)
#overwrite also creates the table from scratch
dbWriteTable(con, "R",r,overwrite=TRUE, append=FALSE)
