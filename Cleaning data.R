install.packages("pdftools")
install.package("stringr")
install.packages("tm")
library("pdftools")
library("stringr")
library("tm")
#reading data 
company_house <- read.csv("Company_House/companyData.csv", header=T) 
company_house <-company_house[order(company_house$company_name),]
company_house <- company_house[,c(-3, -4, -8, -9, -12, -13, -14, -16, -17, -18, -19, -20, -21, -22, -23, -24, -25, -26,-31,-32,-33,-34,-35,-36,-37,-38,-39,-40,-41,-42,-43,-44,-45,-46,-47,-48,-49,-50,-51, -52, -53, -54, -55)]
write.csv(company_house, file='Company_House/company_detail.csv')

#test <- data.frame(sp=8:27,AUC=1:20)
#test2 <- data.frame(sp=10:29,AUC=1:20)
#z <- merge(test,test2,by=c('sp'),all.x = T)

#full_company_info <- merge(tier2,company_house,by=c('company_name'),all.x = T)

#download.file("https://www.gov.uk/government/uploads/system/uploads/attachment_data/file/682406/2018-02-19_Tier_2_5_Register_of_Sponsors.pdf","./2018-02-19_Tier_2_5_Register_of_Sponsors.pdf")
rawText <- pdf_text("./2018-02-19_Tier_2_5_Register_of_Sponsors.pdf")
doc <- strsplit(rawText, "\n")
head(splitedByLineText)
header_row <- grep("^No. of Sponsors on Register Licensed under Tiers 2 and 5:", doc[[1]])
header_row

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
for (i in 1:3){
  for (j in 1:length(doc[[i]]))
  {
    print(strsplit(doc[[i]][j], "/t"))
  }
}




lt <- text[(sponsor_row + 1) :length(text)]
text2 <- strsplit(text, "\n")
nrow(strsplit(text, "\n"))
typeof(text2)
head(text2[[2]])
firstPage <- strsplit(head(text2[[1]]), "/n")
head(firstPage[[1]])
lastPage <- str_sub(text2[[1909]], 0, 27)
head(lastPage[[1]])
#text2
#typeof(text2)
#length(text2)
text2[[1]]
zz <- 0

for(i in 1:length(text2)) {
  for( j in 1)
  zz[i] <- str_sub(text2[[i]], 0, 27)
}
zz <- data.frame(zz)




