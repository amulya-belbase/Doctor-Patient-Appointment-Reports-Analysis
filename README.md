# Doctor-Patient Appointment, Report, Analytics

This project (was final-year graduation project) aims to provide users with an appointment management system with some additional features. Homepage is DocLab open-source code. Pictures used are also from the same project. (https://github.com/codewithsadee/doclab)

The user can perform CRUD operations on the appointments. They can filter the doctors list based on department and gender. 

They can also view (and download - in pdf format) their lab reports (inserted by the admin). HTML parsing for pdf generation is done by dompdf library. 

This system also contains an analytics page that displays some statistical data in pie-chart. Patient reports can also be analysed. For now, only blood report function is integrated to the system. Therefore, a user with blood report can view their report analysis data. Google charts is used for charts display. 

They can change their user information (email, password). 

Based on the appointments a user has made, related departments are also recommended which can take the user to that department's website that contains faculty, facilities, etc. information. 

For Doctor's interface:
  A doctor can see all the appointments made by patients with that doctor. Can also see the list of doctors (department specific as well as the entire list).

For Admin Interface:
  Right now, the only admin task is to insert the report data into the database. The for_lab page isn't "front-end modified" i.e., the for_lab.html page is styled using water.css. 
  
Since this system was created with SaaS model of software distribution in mind, subscription module is also integrated into the system. A user can buy/renew subscription. Validation mechanism is also applied to the module. 

The system was built on Atom (and VS code) text-editor. HTML, CSS and vanilla JS were used for front-end. PHP handles all the back-end operations. Web-hosting and database-hosting is done by XAMPP. 

System structure looks like this: 

![system structure](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/e1f99c84-336b-4b71-8b64-1a9b05a7e7e2)

Book appointment pop-up:

![appointments page 2](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/62cbf0a8-fdfd-4411-9d3f-12626effe884)

Filter list: 

![filter 4](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/5da19d36-cd38-4802-a8b3-6c2034761361)

Reports page: 

![reports 1](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/4a9919d9-74b7-4918-ad03-7e3d5793894c)

Analytics page: 

![analytics 1](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/045209a7-3670-472e-8831-e4851d17c0e9)

Doctor's Dashboard:

![doctor appointment view](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/6a28e173-00b5-4323-8020-06eefb98d70e)

![doctor dashboard](https://github.com/amulya-belbase/Doctor-Patient-Appointment-Reports-Analysis/assets/138869398/a2bdb474-e1a3-4622-b8cf-dda79ec3478c)


You can reach me on instagram: @amulya_belbase. This project is in no way a perfect system, therefore, additional functionalities can be added. Modifications can be done. I had a fun time building this. Good Luck. 
