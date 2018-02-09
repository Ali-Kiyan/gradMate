import PyPDF2

file=open('b.pdf','rb')
pdfreader=PyPDF2.PdfFileReader(file)
# print(pdfreader.getNumPages())
pageobj=pdfreader.getPage(2)
print(pageobj.extractText())
