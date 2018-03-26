select * FROM company WHERE company_name IN (select company_name from company where 1 GROUP by company_name, main_tier,subtier having COUNT(company_name)>1)
