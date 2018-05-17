install.packages("pdftools")
install.package("stringr")
library("pdftools")
library("stringr")


rawText <- pdf_text("./2018-05-16_Tier_2_5_Register_of_Sponsors.pdf")
doc <- strsplit(rawText, "\n")
head(doc)
header_row <- grep("^No. of Sponsors on Register Licensed under Tiers 2 and 5:", doc[[1]])
header_row

doc[[1000]]
#header removal 
doc[[1]] <- doc[[1]][(header_row + 1):length(doc[[1]])]
head(doc)
tail(doc)
length(doc)
#footer removal 
footer_row_1 <- grep("Summary", doc[[length(doc)]])
footer_row_2 <- grep("Total Number of Sponsors registered under Tiers 2 and 5",doc[[length(doc)]])
footer_row_1
footer_row_2
doc[[length(doc)]] <- doc[[length(doc)]][-c(footer_row_1:footer_row_2)]
head(doc)
tail(doc)
length(doc[[1]])
tier2 <- 0
tier2 <- data.frame(tier2)
for (i in 1:length(doc)){
  for (j in 1:length(doc[[i]]))
  {
    tier2 <- c(tier2,strsplit(doc[[i]][j], "   ")[[1]][1])
  }
}




for (i in length(tier2):1){
  if( (str_detect(tier2[[i]], "  Organisation Name")) || (str_detect(tier2[[i]], "^ $")) || (str_detect(tier2[[i]], "^0$")) || (str_detect(tier2[[i]], "^$")) || (str_detect(tier2[[i]], " Organisation Name"))  ){
    tier2[[i]] <- NULL
  }
}

backup <- tier2

temp<- 0
temp <- data.frame(temp)
for(o in 1:length(tier2)){
  temp <- rbind(temp,tier2[[o]])
}

temp <- data.frame(temp[c(-1),])

tier2CompanyList <- temp

tier2CompanyList$company_name <- tier2CompanyList$temp.c..1.... 

tier2CompanyList$temp.c..1....<- NULL

library(RMySQL)
library(dbConnect)
con = dbConnect(MySQL(), user='root', password='root', dbname='jobWizard', host='localhost',unix.sock="/Applications/MAMP/tmp/mysql/mysql.sock")
dbListTables(con)
typeof(temp)


dbWriteTable(con, "UpdatedCompanies2", tier2CompanyList,overwrite=FALSE, append=TRUE,  field.types = NULL)







