install.packages("pdftools")
install.package("stringr")
install.packages("tm")
library("pdftools")
library("stringr")
library("tm")
library("dplyr")
#cleaning data
company_house <- read.csv("Company_House/companyData.csv", header=T)
company_house <-company_house[order(company_house$company_name),]
company_house <- company_house[,c(-3, -4, -8, -9, -12, -13, -14, -16, -17, -18, -19, -20, -21, -22, -23, -24, -25, -26,-31,-32,-33,-34,-35,-36,-37,-38,-39,-40,-41,-42,-43,-44,-45,-46,-47,-48,-49,-50,-51, -52, -53, -54, -55)]
write.csv(company_house, file='Company_House/company_detail.csv')

company_house <- read.csv('Company_House/company_detail.csv', header=T)

#test <- data.frame(sp=8:27,AUC=1:20)
#test2 <- data.frame(sp=10:29,AUC=1:20)
#z <- merge(test,test2,by=c('sp'),all.x = T)

#full_company_info <- merge(tier2,company_house,by=c('company_name'),all.x = T)

#download.file("https://www.gov.uk/government/uploads/system/uploads/attachment_data/file/682406/2018-02-19_Tier_2_5_Register_of_Sponsors.pdf","./2018-02-19_Tier_2_5_Register_of_Sponsors.pdf")
rawText <- pdf_text("./2018-02-19_Tier_2_5_Register_of_Sponsors.pdf")
doc <- strsplit(rawText, "\n")
head(doc)
header_row <- grep("^No. of Sponsors on Register Licensed under Tiers 2 and 5:", doc[[1]])
header_row

doc[[1]]
#header removal
doc[[1]] <- doc[[1]][(header_row + 1):length(doc[[1]])]
head(doc)
tail(doc)
length(doc)
#footer removal
footer_row_1 <- grep("Summary", doc[[1909]])
footer_row_2 <- grep("Total Number of Sponsors registered under Tiers 2 and 5",doc[[1909]])
footer_row_1
footer_row_2
doc[[1909]] <- doc[[1909]][-c(footer_row_1:footer_row_2)]
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


dbWriteTable(con, "R", tier2CompanyList,overwrite=FALSE, append=FALSE, row.names = TRUE,  field.types = NULL)

#it is slow in mysql so I tried R

insert into R (company_name) select company_name from company where not EXISTS( select R.company_name from R where R.company_name = company.company_name) LIMIT 1

query <- "select company_name from company"
result <- dbGetQuery(con, query)
result == tier2CompanyList



if ( isTRUE(all.equal(result,tier2CompanyList)) == TRUE ) {

  if()



}else{
  print("It is updated")
}
