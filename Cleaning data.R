#reading data 
tier2 <- read.csv("sponsorList.csv", header=T) 
company_house <- read.csv("companyData.csv", header=T) 
company_house <-company_house[order(company_house$company_name),]
company_house <- company_house[,c(-3,-4,-8,-9,-10,-12,-13,-14,-15,-16,-17,-18,-19,-20,-21,-22,-27,-28,-30,-31,-32,-33,-34,-35,-36,-37,-38,-39,-40,-41,-42,-43,-44,-45,-46,-47,-48,-49,-50,-51)]
write.csv(company_house, file='company_detail.csv')
test <- data.frame(sp=8:27,AUC=1:20)
test2 <- data.frame(sp=10:29,AUC=1:20)
z <- merge(test,test2,by=c('sp'),all.x = T)
test 
full_company_info <- merge(tier2,company_house,by=c('company_name'),all.x = T)
install.packages("pdftools")
install.package("stringr")
library("pdftools")
library("stringr")
download.file("https://www.gov.uk/government/uploads/system/uploads/attachment_data/file/682406/2018-02-19_Tier_2_5_Register_of_Sponsors.pdf","./2018-02-19_Tier_2_5_Register_of_Sponsors.pdf")
text <- pdf_text("./2018-02-19_Tier_2_5_Register_of_Sponsors.pdf")
text2 <- strsplit(text, "\n")
typeof(text2)
head(text2[[2]])
a <- strsplit(head(text2[[1]]), "/n")
head(a[[1]])
b <- str_sub(text2[[1909]], 0, 27)
text2
typeof(text2)
length(text2)
for (v in text2) {
  <- str_sub(v, 0, 27)
}
xx <- 0 
xx = data.frame(xx)
length(text2)
for(i in 1:length(text2)) {
  xx[i, str_sub(text2[[i]], 0, 27)
     xx <- data.frame(xx)
}




