import PyPDF2
file=open('./b.pdf','rb')
# file=file.split("\n")
pdfreader=PyPDF2.PdfFileReader(file)
# print(pdfreader.getNumPages())
pageobj=pdfreader.getPage(0)
# pagefields=pdfreader.getDocumentInfo()
print(pageobj.extractText())
# print(pagefields)
pagepbj
