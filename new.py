import PyPDF2
import subprocess

command = 'Rscript'

pathToScript = './test.R'

# cmd = [command, path2script]

# x = subprocess.check_output(cmd, universal_newlines=True)
print('Hello world')



file=open('./b.pdf','rb')
# file=file.split("\n")
pdfreader=PyPDF2.PdfFileReader(file)
# print(pdfreader.getNumPages())
pageobj=pdfreader.getPage(0)
# pagefields=pdfreader.getDocumentInfo()
print(pageobj.extractText())
# print(pagefields)
# print(pdfreader.extractText())
