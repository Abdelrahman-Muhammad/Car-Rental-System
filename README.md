# Rent A Car

> The system is built using HTML, Tailwind CSS, JavaScript, PHP and MySQL.

### The car rental system embodies a sophisticated platform tailored to meet the diverse needs of both administrators and users with precision and efficiency. The system supports multiple branches and locations, providing a seamless and efficient platform for car rentals. It includes a robust database system for managing cars, users, reservations, and payments.
>
![Home](https://github.com/Abdelrahman-Muhammad/Car-Rental-System/assets/97410751/2643ed73-7910-488c-8ac3-f8e104222ebd)



## User Interface

Conversely, users interface with a seamlessly designed platform that prioritizes user experience and accessibility.
![User](https://github.com/Abdelrahman-Muhammad/Car-Rental-System/assets/97410751/c8edf8fb-ffad-4ee8-96ee-e479a1e8ceea)


 - **Car Reservation**
The intuitive interface facilitates effortless car reservations, enabling users to select from an array of available vehicles tailored to their preferences and requirements.

 - **Debt Tracking**
Users benefit from transparent visibility into their financial obligations through the debt tracking feature, fostering financial acumen and ensuring timely payments.

 - **Reservation History**
Users can access their reservation history, affording them the opportunity to review past bookings and track their rental activity meticulously.

 - **All Reservations**
The All Reservations feature presents users with a comprehensive repository of all reservations made within the system, empowering them with enhanced planning capabilities and facilitating seamless rental experiences.

## Administrator Capabilities

Administrators wield a comprehensive suite of functionalities aimed at meticulous management and optimization of rental operations.
![Admin](https://github.com/Abdelrahman-Muhammad/Car-Rental-System/assets/97410751/ff0fc376-369f-49b1-8ecd-cad9566f92fe)



 - **Add Car**
	Administrators possess the authority to expand the fleet seamlessly by incorporating new vehicles with detailed specifications such as model, year, price, color, and more.

 - **Edit Car**
Through the Edit Car feature, administrators maintain the integrity of the system's database by swiftly updating existing vehicle details as necessitated by evolving requirements, ensuring accuracy and relevance.

 - **Add Admin**
The capability to Add Admin empowers administrators to strategically delegate responsibilities and extend access privileges to additional personnel, fostering a collaborative and streamlined administrative environment.

 - **Add Location**
Administrators can seamlessly integrate multiple rental locations into the system's framework, enhancing accessibility and convenience for users spanning various geographic regions.

 - **View Reservations**
Critical to effective decision-making and resource management, administrators can leverage the View Reservations feature to gain comprehensive insights into the current reservation landscape, empowering them to strategize and allocate resources judiciously.

 - **Daily Payments**
The Daily Payments functionality enables administrators to meticulously track and manage rental payments on a daily basis, fostering financial transparency and accountability within the system's ecosystem.

 - **Status Monitoring**
Augmenting administrative prowess, the Status Monitoring feature provides a holistic snapshot of the system's operational dynamics, encompassing vital parameters such as vehicle availability, rental location status, and reservation statistics.

## Search Capabilities

The car rental system includes powerful search features for both users and administrators:

-   **Search Cars by Model**: Locate vehicles by specific models to match preferences or requirements.
-   **Search Cars by Transmission**: Filter cars by transmission type (automatic or manual) for user comfort.
-   **Search Cars by Color**: Find vehicles by color for a personalized rental experience.
-   **Search Cars by Price**: Identify cars within a specific budget for cost-effective options.
-   **Search Users**: Quickly find and manage user information and activities.
-   **Search Branches**: Locate rental branches for convenience and operational management.


### Workflow

1.  **User Registration and Authentication**: Users register and log in via HTML forms, validated by JavaScript, and processed by PHP to interact with MySQL.
2.  **Car Reservation**: Users browse and reserve cars through a dynamic interface. JavaScript sends data to PHP scripts, which update the database.
3.  **Debt Tracking**: PHP scripts query the `payments` table, and JavaScript updates the UI with the user’s financial status.
4.  **Reservation History and All Reservations**: PHP retrieves and sends reservation data to the frontend, rendered by JavaScript.
5.  **Add/Edit Car**: Admins manage car details via forms. PHP scripts update the `cars` table.
6.  **Add Admin and Add Location**: Admins add new admins or locations through forms, with PHP updating the respective database tables.
7.  **View Reservations and Daily Payments**: Admins view and manage reservations and payments using PHP to fetch data, displayed dynamically by JavaScript.
8.  **Status Monitoring**: PHP scripts check system parameters, with JavaScript providing real-time updates to the admin dashboard.
9.   **Search Cars by Model/Transmission/Color/Price**: JavaScript captures search criteria, PHP queries the `cars` table, and results are dynamically displayed.
10.   **Search Users**: Admins search for users via forms; PHP queries the `users` table.
11.   **Search Branches**: Admins and users search for branches, processed by PHP and displayed by JavaScript.

## ERD Diagram
![ERD Diagram](https://github.com/Abdelrahman-Muhammad/Car-Rental-System/blob/main/ERD%20and%20report/Blank%20diagram%20(3).png)


