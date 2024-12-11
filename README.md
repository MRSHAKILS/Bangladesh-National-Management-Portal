# Bangladesh-National-Management-Portal
<h2>Bangladesh-National-Management-Portal</h2>
<p>This is a website that has a dashboard with all the department's info along with a Portal system where users can Sign Up and Log in as Citizens or expats and then make single or multiple service requests to different departments. 
After making a request, users will be given a unique request ID, their request status, and the department name to which their request is submitted.
There will be Officials and admins who can manage, approve, and deny users' requests. Officials and Admins have different roles. Officials can see the Request ID	Request Type, which department the request was requested, and the ID of the User who requested the service. Officails can 	Approve	Deny or keep the requst waiting for pending or submit the request to the admins for approval.
Admins can see the Request ID	Request Type, which department the request was requested, the ID of the User who requested service, and the request status. Admin can approve the complited and denied request. After approval, the user can see in their profile their request status. and after a request status is updated, the user can leave a review. These reviews will be shown in the dashboard carousel.

</p>

# Bangladesh National Portal Management System (BNPMS)

The **Bangladesh National Portal Management System (BNPMS)** aims to integrate public service delivery into a centralized digital framework, enhancing efficiency, transparency, and accessibility.

## Features

### Citizen Services
- Submit and track service requests.
- Provide feedback on completed services.
- Receive notifications about request updates.

### Government Officials
- Manage and oversee service requests.
- Monitor departmental performance metrics.

### Administrators
- Approve or reject service requests.
- Access comprehensive data for all departments.

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP, MySQL
- **Database**: Relational database with complex entity relationships.
- **Triggers**: Automatically calculate derived attributes (e.g., age).
- **Procedures and Functions**: Automate tasks and generate reports.

## Database Schema Highlights
- **User Types**: Citizen, Expat, Government Official.
- **Services**: Track service requests, feedback, and history.
- **Notifications**: Notify users of updates.

## Getting Started

### Prerequisites
- **Server Environment**: XAMPP/WAMP (or equivalent for PHP and MySQL).
- **Dependencies**: Ensure PHP and MySQL are installed.

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/bnpms.git
   cd bnpms
   ```
2. Set up the database:
   - Import the SQL schema from `database/schema.sql` into your MySQL server.
3. Configure the database connection:
   - Update `db.php` with your database credentials:
     ```php
     $host = 'localhost';
     $db = 'bnpms';
     $user = 'root';
     $password = '';
     ```
4. Start the server and navigate to the portal.

### Usage
- **Sign Up**: Citizens and Expats can register through the portal.
- **Sign In**: Access the dashboard with appropriate permissions:
  - Citizens: Submit and track requests.
  - Officials: Manage and approve requests.
  - Admin: Oversee all requests and approve/reject them.

## Contribution

### Contributors
- **Shakil Ahmed**:
  - SQL scripts and backend functionalities.
  - Authentication and role management.
  - Request approval and review modules.
  - Final project report.

- **Nael**:
  - ERD and database design.
  - Dashboard UI development.

### Contribution Breakdown
- **Shakil Ahmed**: 80%
- **Nael**: 20%

## Screenshots
- Citizen Dashboard: Overview of requests and statuses.
- Official Dashboard: Pending requests for approval.
- Admin Dashboard: Final approval section.

*(Add screenshots in the `assets/screenshots` folder and reference them here)*

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For any inquiries or contributions, please reach out:
- Shakil Ahmed: [work.ahmedshakil@gmail.com](mailto:work.ahmedshakil@gmail.com)

---

> *“Empowering citizens, enhancing efficiency, and promoting transparency through digital governance.”*

