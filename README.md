**Laravel Chat Application with Breeze, TALL Stack, and Reverb**

**Description:**
This project is a real-time chat application built using Laravel with Breeze for authentication, the TALL stack (Tailwind CSS, Alpine.js, Livewire, and Laravel), and Reverb for broadcasting real-time messages to users. The application aims to provide users with a seamless and interactive messaging experience, allowing them to communicate in real-time.

**Features implemented:**

- User authentication and registration with Laravel Breeze.
- Dynamic and reactive frontend interactions powered by the TALL stack.
- Secure storage and retrieval of messages using Laravel's Eloquent ORM with MySQL.
- Responsive user interface for optimal viewing across devices.
- Deletin a whole conversation

**Features to be implemented:**

- Real-time messaging using Reverb for broadcasting.
- Deleting selected messages
- Updating profile pictures(Currently using random image generator)
- Adding and removing friends
- Landing page


**Installation:**

1. Clone the repository: `git clone [repository_url]`
2. Navigate to the project directory: `cd laravel-chat-app`
3. Install PHP dependencies: `composer install`
4. Install NPM dependencies: `npm install`
5. Copy the `.env.example` file to `.env` and configure your environment variables, including database settings and Reverb configuration.
6. Generate application key: `php artisan key:generate`
7. Migrate the database: `php artisan migrate`
8. Serve the application: `php artisan serve`
9. Build node  modules: `npx mix` or `npm run dev` (for development) / `npm run prod` (for production)
10. Visit your application  in the browser at http://localhost:8000/

**Note:**

To use this chat app you need to have NodeJS installed on your machine as well as npm. You can download it from https://nodejs.


**Usage:**

1. Register a new account or log in to an existing one.
2. Start messaging with other users in real-time.
3. Open a new browser window in incognito or use a different browser to log in as the other user and chat from there.

**Technologies Used:**

- Laravel Breeze
- TALL Stack (Tailwind CSS, Alpine.js, Livewire, Laravel)
- Reverb
- MySQL
- PHP

**Contributing:**
Contributions are welcome! Feel free to submit pull requests or open issues for any bugs or feature requests.

**License:**
This project is licensed under the [MIT License](LICENSE).

**Acknowledgements:**

- Laravel Community
- Tailwind CSS Community
- Alpine.js Community
- Livewire Community
- Reverb Community

**Contact:**
For any inquiries or support, please contact me via [Email](jerryjuma104@gmail.com).

**Repository:** [Link to GitHub Repository](https://github.com/wezer-pixel/W100Chat.git)
