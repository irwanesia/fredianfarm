<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CiAuth;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User;
use App\Libraries\Hash;
use App\Models\Settings;
use App\Models\SocialMedia;
use App\Models\Category;
use PHPUnit\TextUI\XmlConfiguration\Group;
use SSP;
use Mberecall\CI_Slugify\SlugService;
use App\Models\SubCategory;
use App\Models\Post;

class AdminController extends BaseController
{
    protected $helpers = ['url', 'form', 'CIMail', 'CIFunctions'];
    protected $db;

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.php';
        $this->db = db_connect();
    }

    public function index()
    {
        // echo 'admin dashboard home';
        $data = [
            'pageTitle' => 'Dashboard',
        ];
        return view('backend/pages/home', $data);
    }

    public function logoutHandler()
    {
        // echo 'kode logout';
        CiAuth::forget();
        return redirect()->route('admin.login.form')->with('fail', 'You are logged out!');
    }

    public function profile()
    {
        $data = [
            'pageTitle' => 'Profile'
        ];

        return view('backend/pages/profile', $data);
    }

    public function updatePersonalDetails()
    {
        // Mengambil instance dari service request di CodeIgniter.
        $request = \Config\Services::request();
        // Mengambil instance dari service validation di CodeIgniter.
        $validation = \Config\Services::validation();
        // Mengambil ID pengguna yang sedang login menggunakan library CiAuth.
        $user_id = CiAuth::id();

        // Baris kode $request->isAJAX() digunakan untuk memeriksa apakah permintaan yang diterima oleh server adalah permintaan AJAX. AJAX (Asynchronous JavaScript and XML) adalah teknik yang memungkinkan halaman web untuk mengirim dan menerima data secara asinkron tanpa perlu memuat ulang halaman secara keseluruhan
        // Dalam CodeIgniter 4, metode isAJAX() pada objek request ($request) membantu mengidentifikasi jenis permintaan tersebut. Ini berguna jika Anda ingin menangani permintaan AJAX secara berbeda dari permintaan HTTP biasa
        if ($request->isAJAX()) {
            $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Full name is required'
                    ]
                ],
                'username' => [
                    'rules' => 'required|min_length[4]|is_unique[users.username,id,' . $user_id . ']',
                    'errors' => [
                        'required' => 'Username is required',
                        'min_length' => 'Username must have minimum of 4 characters',
                        'is_unique' => 'Username is ready taken!',
                    ]
                ]
            ]);

            if ($validation->run() == FALSE) {
                $errors = $validation->getErrors();
                return json_encode(['status' => 0, 'error' => $errors]);
            } else {
                $user = new User();
                // dd($request->getVar('name'));
                $update = $user->where('id', $user_id)
                    ->set([
                        'name' => $request->getVar('name'),
                        'username' => $request->getVar('username'),
                        'bio' => $request->getVar('bio'),
                    ])->update();

                if ($update) {
                    $user_info = $user->find($user_id);
                    return json_encode(['status' => 1, 'user_info' => $user_info, 'msg' => 'Your personal details have been succesfully updated']);
                } else {
                    return json_encode(['status' => 0, 'msg' => 'something went wrong']);
                }
            }
        }
    }

    public function changePassword()
    {
        $request = \Config\Services::request();
        // Mengambil instance dari service request di CodeIgniter.
        // $request = \Config\Services::request();
        // // Mengambil instance dari service validation di CodeIgniter.
        // $validation = \Config\Services::validation();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $user_id = CiAuth::id();
            $user = new User();
            $user_info = $user->asObject()->where('id', $user_id)->first();

            // validate the form
            $this->validate([
                'current_password' => [
                    'rules' => 'required|min_length[5]|check_current_password[current_password]',
                    'errors' => [
                        'required' => 'Enter current password',
                        'min_length' => 'Password must have atleast 5 characters',
                        'check_current_password' => 'The current password is incorrect'
                    ]
                ],
                'new_password' => [
                    'rules' => 'required|min_length[5]|max_length[20]|is_password_strong[new_password]',
                    'errors' => [
                        'required' => 'New password is required',
                        'min_length' => 'New password must have atleast 5 characters',
                        'max_length' => 'New password must not excess more than 20 characters',
                        'is_password_strong' => 'Password must contains atleast 1 uppercase, 1 lowercase, 1 number and special character.',
                    ]
                ],
                'confirm_new_password' => [
                    'rules' => 'required|matches[new_password]',
                    'errors' => [
                        'required' => 'Confirm new password',
                        'matches' => 'Password mismatch'
                    ]
                ]
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Good']);

                // update user(admin) password in db
                $user->where('id', $user_info->id)
                    ->set(['password' => Hash::make($request->getVar('new_password'))])
                    ->update();

                // send notification to user (admin) email address
                $mail_data = array(
                    'user' => $user_info,
                    'new_password' => $request->getVar('new_password')
                );

                $view = \Config\Services::renderer();
                $mail_body = $view->setVar('mail_data', $mail_data)->render('email-template/password-changed-email-tamplate');

                $mailConfig = array(
                    'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                    'mail_from_name' => env('EMAIL_FROM_NAME'),
                    'mail_recipient_email' => $user_info->email,
                    'mail_recipient_name' => $user_info->name,
                    'mail_subject' => 'Password Changed',
                    'mail_body' => $mail_body,
                );

                sendEmail($mailConfig);
                return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Done! Your password has been successfully update']);
            }
        }
    }

    // settings
    public function settings()
    {
        $data = [
            'pageTitle' => 'Settings'
        ];

        return view('backend/pages/settings', $data);
    }

    public function updateGeneralSettings()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();

            // validate the form
            $this->validate([
                'blog_title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Blog title is required'
                    ]
                ],
                'blog_email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Blog email is required',
                        'valid_email' => 'Invalid email address',
                    ]
                ]

            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Good']);
                $settings = new Settings();
                $setting_id = $settings->asObject()->first()->id;
                $update = $settings->where('id', $setting_id)
                    ->set([
                        'blog_title' => $request->getVar('blog_title'),
                        'blog_email' => $request->getVar('blog_email'),
                        'blog_phone' => $request->getVar('blog_phone'),
                        'blog_meta_keywords' => $request->getVar('blog_meta_keywords'),
                        'blog_meta_description' => $request->getVar('blog_meta_description')
                    ])->update();

                if ($update) {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Done! General settings has been successfully update']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong']);
                }
            }
        }
    }

    public function updateBlogLogo()
    {
        $request = \Config\Services::request();

        if (!$request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 0, 
                'token' => csrf_hash(), 
                'msg' => 'Invalid request method. Please use AJAX.'
            ]);
        }

        try {
            $settings = new Settings();
            $path = FCPATH . 'images/blog/'; // Gunakan FCPATH untuk path absolute
            $file = $request->getFile('blog_logo');
            
            // Validasi file
            if (!$file || !$file->isValid()) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'No valid file uploaded or file upload error: ' . ($file ? $file->getErrorString() : 'File not found')
                ]);
            }

            // Validasi tipe file
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'Invalid file type. Allowed types: JPEG, JPG, PNG, GIF, WEBP'
                ]);
            }

            // Validasi ukuran file (max 5MB)
            if ($file->getSize() > 5 * 1024 * 1024) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'File too large. Maximum size is 5MB'
                ]);
            }

            $setting_data = $settings->asObject()->first();
            
            if (!$setting_data) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'Settings data not found'
                ]);
            }

            $old_blog_logo = $setting_data->blog_logo;
            
            // Generate nama file yang lebih aman
            $extension = $file->getClientExtension();
            $new_filename = 'fredian_farm_logo_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;

            // Pastikan directory exists
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            // Pindahkan file baru
            if ($file->move($path, $new_filename)) {
                
                // Hapus file lama jika ada dan bukan default
                if ($old_blog_logo != null && file_exists($path . $old_blog_logo)) {
                    // Optional: Cek apakah file lama adalah default logo, jika iya jangan dihapus
                    if (!$this->isDefaultLogo($old_blog_logo)) {
                        unlink($path . $old_blog_logo);
                    }
                }

                // Update database
                $update = $settings->where('id', $setting_data->id)
                    ->set(['blog_logo' => $new_filename])
                    ->update();

                if ($update) {
                    return $this->response->setJSON([
                        'status' => 1, 
                        'token' => csrf_hash(), 
                        'msg' => 'Done! Blog logo has been successfully updated.',
                        'new_filename' => $new_filename // Optional: untuk update preview di frontend
                    ]);
                } else {
                    // Jika update database gagal, hapus file yang sudah diupload
                    if (file_exists($path . $new_filename)) {
                        unlink($path . $new_filename);
                    }
                    return $this->response->setJSON([
                        'status' => 0, 
                        'token' => csrf_hash(), 
                        'msg' => 'Failed to update logo information in database'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'Failed to move uploaded file: ' . $file->getErrorString()
                ]);
            }

        } catch (\Exception $e) {
            // Log error untuk debugging
            log_message('error', 'Error in updateBlogLogo: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 0, 
                'token' => csrf_hash(), 
                'msg' => 'Server error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Helper function untuk cek apakah logo adalah logo default
     * Sesuaikan dengan nama file logo default Anda
     */
    private function isDefaultLogo($filename)
    {
        $defaultLogos = ['default_logo.png', 'default-logo.jpg']; // Sesuaikan dengan nama default logo Anda
        return in_array($filename, $defaultLogos);
    }

    public function updateBlogFavicon()
    {
        $request = \Config\Services::request();

        if (!$request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 0, 
                'token' => csrf_hash(), 
                'msg' => 'Invalid request method. Please use AJAX.'
            ]);
        }

        try {
            $settings = new Settings();
            $path = FCPATH . 'images/blog/'; // Gunakan FCPATH untuk path absolute
            $file = $request->getFile('blog_favicon');
            
            // Validasi file
            if (!$file || !$file->isValid()) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'No valid file uploaded or file upload error: ' . ($file ? $file->getErrorString() : 'File not found')
                ]);
            }

            // Validasi tipe file khusus favicon
            $allowedTypes = ['image/x-icon', 'image/vnd.microsoft.icon', 'image/png', 'image/jpeg', 'image/jpg'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'Invalid file type for favicon. Allowed types: ICO, PNG, JPEG, JPG'
                ]);
            }

            // Validasi ukuran file (max 1MB untuk favicon)
            if ($file->getSize() > 1 * 1024 * 1024) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'File too large. Maximum size for favicon is 1MB'
                ]);
            }

            $setting_data = $settings->asObject()->first();
            
            if (!$setting_data) {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'Settings data not found'
                ]);
            }

            $old_blog_favicon = $setting_data->blog_favicon;
            
            // Generate nama file yang lebih baik
            $extension = $file->getClientExtension();
            $new_filename = 'favicon_' . time() . '.' . $extension;

            // Pastikan directory exists
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            // Pindahkan file baru
            if ($file->move($path, $new_filename)) {
                
                // PERBAIKAN: Hapus file lama jika ada
                if (!empty($old_blog_favicon) && file_exists($path . $old_blog_favicon)) {
                    // Optional: Cek apakah file lama adalah default favicon
                    if (!$this->isDefaultFavicon($old_blog_favicon)) {
                        @unlink($path . $old_blog_favicon);
                    }
                }

                // Update database
                $update = $settings->where('id', $setting_data->id)
                    ->set(['blog_favicon' => $new_filename])
                    ->update();

                if ($update) {
                    return $this->response->setJSON([
                        'status' => 1, 
                        'token' => csrf_hash(), 
                        'msg' => 'Done! Blog favicon has been successfully updated.',
                        'new_filename' => $new_filename // Untuk update preview di frontend
                    ]);
                } else {
                    // Rollback: hapus file baru jika update database gagal
                    if (file_exists($path . $new_filename)) {
                        unlink($path . $new_filename);
                    }
                    return $this->response->setJSON([
                        'status' => 0, 
                        'token' => csrf_hash(), 
                        'msg' => 'Failed to update favicon information in database'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => 0, 
                    'token' => csrf_hash(), 
                    'msg' => 'Failed to move uploaded file: ' . $file->getErrorString()
                ]);
            }

        } catch (\Exception $e) {
            // Log error untuk debugging
            log_message('error', 'Error in updateBlogFavicon: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 0, 
                'token' => csrf_hash(), 
                'msg' => 'Server error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Helper function untuk cek apakah favicon adalah default
     */
    private function isDefaultFavicon($filename)
    {
        $defaultFavicons = ['default_favicon.ico', 'favicon.ico']; // Sesuaikan dengan nama default favicon Anda
        return in_array($filename, $defaultFavicons);
    }

    public function updateSocialMedia()
    {
        // Mengambil instance dari service request di CodeIgniter.
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $this->validate([
                'facebook_url' => [
                    'rules' => 'permit_empty|valid_url_strict',
                    'errors' => [
                        'valid_url_strict' => 'Invalid facebook url'
                    ]
                ],
                'twitter_url' => [
                    'rules' => 'permit_empty|valid_url_strict',
                    'errors' => [
                        'valid_url_strict' => 'Invalid twitter url'
                    ]
                ],
                'instagram_url' => [
                    'rules' => 'permit_empty|valid_url_strict',
                    'errors' => [
                        'valid_url_strict' => 'Invalid instagram url'
                    ]
                ],
                'youtube_url' => [
                    'rules' => 'permit_empty|valid_url_strict',
                    'errors' => [
                        'valid_url_strict' => 'Invalid youtube url'
                    ]
                ],
                'github_url' => [
                    'rules' => 'permit_empty|valid_url_strict',
                    'errors' => [
                        'valid_url_strict' => 'Invalid github url'
                    ]
                ],
                'linkedin_url' => [
                    'rules' => 'permit_empty|valid_url_strict',
                    'errors' => [
                        'valid_url_strict' => 'Invalid linkedin url'
                    ]
                ],
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'form validated..']);

                $social_media = new SocialMedia();
                $social_media_id = $social_media->asObject()->first()->id;
                $update = $social_media->where('id', $social_media_id)
                    ->set([
                        'facebook_url' => $request->getVar('facebook_url'),
                        'twitter_url' => $request->getVar('twitter_url'),
                        'instagram_url' => $request->getVar('instagram_url'),
                        'youtube_url' => $request->getVar('youtube_url'),
                        'github_url' => $request->getVar('github_url'),
                        'linkedin_url' => $request->getVar('linkedin_url'),
                    ])->update();

                if ($update) {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Done!, Dieng social media has been successfully updated.']);
                } else {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Something went wrong on updating dieng social media.']);
                }
            }
        }
    }

    // category
    public function categories()
    {
        $data = [
            'pageTitle' => 'Categories'
        ];

        return view('backend/pages/categories', $data);
    }

    public function addCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $this->validate([
                'category_name' => [
                    'rules' => 'required|is_unique[categories.name]',
                    'errors' => [
                        'required' => 'Category name is required',
                        'is_unique' => 'Category name is already exists'
                    ]
                ]
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // add category
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'form validated..']);
                $category = new Category();
                $save = $category->save(['name' => $request->getVar('category_name')]);

                if ($save) {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'New category has been successfuly added.']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong.']);
                }
            }
        }
    }

    public function getCategories()
    {
        // db details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database
        );

        $table = "categories";
        $primaryKey = "id";
        $columns = array(
            array(
                "db" => "id",
                "dt" => 0
            ),
            array(
                "db" => "name",
                "dt" => 1
            ),
            array(
                "db" => "id",
                "dt" => 2,
                "formatter" => function ($d, $row) {
                    // return "(x) will be added later";
                    $subcategory = new SubCategory();
                    $subcategories = $subcategory->where(['parent_cat' => $row['id']])->findAll();
                    return count($subcategories);
                }
            ),
            array(
                "db" => "id",
                "dt" => 3,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-link p-0 mx-1 editCategoryBtn' data-id='" . $row['id'] . "'>edit</button></div>
                    <button class='btn btn-sm btn-link p-0 mx-1 deleteCategoryBtn' data-id='" . $row['id'] . "'>delete</button>
                    </div>";
                }
            ),
            array(
                "db" => "ordering",
                "dt" => 4
            ),
        );

        return json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }

    public function getCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            // $validation = \Config\Services::validation();
            // $this->validate([
            //     'category_name' => [
            //         'rules' => 'required|is_unique[categories.name]',
            //         'errors' => [
            //             'required' => 'Category name is required',
            //             'is_unique' => 'Category name is already exists'
            //         ]
            //     ]
            // ]);

            $id = $request->getVar('category_id');
            $category = new Category();
            $category_data = $category->find($id);
            return $this->response->setJSON(['data' => $category_data]);
        }
    }

    public function updateCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('category_id');
            $validation = \Config\Services::validation();

            $this->validate([
                'category_name' => [
                    'rules' => 'required|is_unique[categories.name, id, ' . $id . ']',
                    'errors' => [
                        'required' => 'Category name is required',
                        'is_unique' => 'Category name is already exists'
                    ]
                ]
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'form updated..']);
                $category = new Category();
                $update = $category->where('id', $id)
                    ->set(['name' => $request->getVar('category_name')])
                    ->update();

                if ($update) {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Category has been successfuly updated.']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong.']);
                }
            }
        }
    }

    public function deleteCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('category_id');
            $category = new Category();

            // check it's relate sub categories : in future video

            // check it's relate post through it's subcateories : in future video

            // delete category
            // bisa menggunakan delete dengan kode ini
            // $delete = $category->where('id',$id)->delete();

            // bisa juga dengan kode berikut
            // $delete = $category->delete($id);

            // if ($delete) {
            //     return $this->response->setJSON(['status' => 1, 'msg' => 'Category has been successfully deleted.']);
            // } else {
            //     return $this->response->setJSON(['status' => 0, 'msg' => 'Something went wrong.']);
            // }

            // delete jika kondisi subcategory ada data yg berrelasi dengan data category
            $subcategory = new SubCategory();
            $subcategories = $subcategory->where('parent_cat', $id)->findAll();
            if ($subcategories) {
                $msg = count($subcategories) == 1 ? 'There is (' . count($subcategories) . ') Sub category related to this parent category, so that it can not be deleted.' : 'There are (' . count($subcategories) . ') Sub categories related to this parent category, so that it can not be deleted.';
                return $this->response->setJSON(['status' => 0, 'msg' => $msg]);
            } else {
                // delete category
                $delete = $category->where('id', $id)->delete();
                if ($delete) {
                    return $this->response->setJSON(['status' => 1, 'msg' => 'Category has been succesfully deleted.']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'msg' => 'Something went wrong.']);
                }
            }
        }
    }

    // sub category
    public function getParentCategories()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('parent_category_id');
            $options = '<option value="0">Uncategorized</option>';
            $category = new Category();
            $parent_categories = $category->findAll();

            if (count($parent_categories)) {
                $added_options = '';
                foreach ($parent_categories as $parent_category) {
                    $isSelected = $parent_category['id'] == $id ? 'selected' : '';
                    $added_options .= '<option value="' . $parent_category['id'] . '" ' . $isSelected . '>' . $parent_category['name'] . "</option>";
                }
                $options = $options . $added_options;
                return $this->response->setJSON(['status' => 1, 'data' => $options]);
            } else {
                return $this->response->setJSON(['status' => 1, 'data' => $options]);
            }
        }
    }

    public function addSubCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();

            $this->validate([
                'subcategory_name' => [
                    'rules' => 'required|is_unique[sub_categories.name]',
                    'errors' => [
                        'required' => 'Sub category name is required',
                        'is_unique' => 'Sub category name is already exists',
                    ]
                ],
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Validated....']);
                $subcategory = new SubCategory();
                $subcategory_name = $request->getVar('subcategory_name');
                $subcategory_description = $request->getVar('description');
                $subcategory_parent_category = $request->getVar('parent_cat');
                $subcategory_slug = SlugService::model(SubCategory::class)->make($subcategory_name); // slugservie didapat dari download dari library slugify

                $save = $subcategory->save([
                    'name' => $subcategory_name,
                    'parent_cat' => $subcategory_parent_category,
                    'slug' => $subcategory_slug,
                    'description' => $subcategory_description
                ]);

                if ($save) {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'New sub category has been added']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Somtehing went wrong.']);
                }
            }
        }
    }

    public function getSubCategories()
    {
        $category = new Category();
        $subcategory = new SubCategory();

        // db details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database
        );

        $table = "sub_categories";
        $primaryKey = "id";
        $columns = array(
            array(
                "db" => "id",
                "dt" => 0
            ),
            array(
                "db" => "name",
                "dt" => 1
            ),
            array(
                "db" => "id",
                "dt" => 2,
                "formatter" => function ($d, $row) use ($category, $subcategory) {

                    $parent_cat_id = $subcategory->asObject()->where('id', $row['id'])->first()->parent_cat;
                    $parent_cat_name = ' - ';
                    if ($parent_cat_id != 0) {
                        $parent_cat_name = $category->asObject()->where('id', $parent_cat_id)->first()->name;
                    }
                    return $parent_cat_name;
                }
            ),
            array(
                "db" => "id",
                "dt" => 3,
                "formatter" => function ($d, $row) {
                    // return "(x) will be added later";
                    $post = new Post();
                    $posts = $post->where(['category_id' => $row['id']])->findAll();
                    return count($posts);
                }
            ),
            array(
                "db" => "id",
                "dt" => 4,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                    <button class='btn btn-sm btn-link p-0 mx-1 editSubCategoryBtn' data-id='" . $row['id'] . "'>edit</button></div>
                    <button class='btn btn-sm btn-link p-0 mx-1 deleteSubCategoryBtn' data-id='" . $row['id'] . "'>delete</button>
                    </div>";
                }
            ),
            array(
                "db" => "ordering",
                "dt" => 5
            ),
        );

        return json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }

    public function getSubCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('subcategory_id');
            $subcategory = new SubCategory();
            $subcategory_data = $subcategory->find($id);
            return $this->response->setJSON(['data' => $subcategory_data]);
        }
    }

    public function updateSubCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('subcategory_id');
            $validation = \Config\Services::validation();

            $this->validate([
                'subcategory_name' => [
                    'rules' => 'required|is_unique[sub_categories.name, id, ' . $id . ']',
                    'errors' => [
                        'required' => 'Sub category name is required',
                        'is_unique' => 'Sub category name is already exists'
                    ]
                ]
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'form updated..']);
                $subcategory = new SubCategory();
                $data = array(
                    'name' => $request->getVar('subcategory_name'),
                    'parent_cat' => $request->getVar('parent_cat'),
                    'description' => $request->getVar('description'),
                );
                $update = $subcategory->update($id, $data);

                if ($update) {
                    return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Sub category has been successfuly updated.']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong.']);
                }
            }
        }
    }

    public function deleteSubCategory()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('subcategory_id');
            $subcategory = new SubCategory();

            // check it's relate sub categories : in future video

            // check it's relate post through it's subcateories : in future video

            // delete category
            // bisa menggunakan delete dengan kode ini
            // $delete = $category->where('id',$id)->delete();

            // bisa juga dengan kode berikut
            // $delete = $subcategory->delete($id);

            // if ($delete) {
            //     return $this->response->setJSON(['status' => 1, 'msg' => 'Sub category has been successfully deleted.']);
            // } else {
            //     return $this->response->setJSON(['status' => 0, 'msg' => 'Something went wrong.']);
            // }

            // pengkondisian jika menghapus data sub category yg berelasi dengan data post
            $post = new Post();
            $posts = $post->where('category_id', $id)->findAll();
            $msg = '';
            if ($posts) {
                $msg = count($posts) == 1 ? 'There is (' . count($posts) . ') Post related to this sub category. So that, it can not be deleted.' : 'There are (' . count($posts) . ') Posts related to this sub category. So that, it can not be deleted.';
                return $this->response->setJSON(['status' => 0, 'msg' => $msg]);
            } else {
                // delete sub category
                $delete = $subcategory->where('id', $id)->delete();
                if ($delete) {
                    return $this->response->setJSON(['status' => 1, 'msg' => 'Sub category has been successfully deleted']);
                } else {
                    return $this->response->setJSON(['status' => 0, 'msg' => 'Something went wrong.']);
                }
            }
        }
    }

    // ============== post ===============
    public function addPost()
    {
        $category = new Category();
        $subcategory = new SubCategory();
        $data = [
            'pageTitle' => 'Add New Post',
            'userId' => CiAuth::id(),
            'categories' => $category->asObject()->findAll(),
            'subcategories' => $subcategory->asObject()->findAll(),
        ];

        return view('backend/pages/new-post', $data);
    }

    public function createPost()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();

            $this->validate([
                'title' => [
                    'rules' => 'required|is_unique[posts.title]',
                    'errors' => [
                        'required' => 'Post title is required',
                        'is_unique' => 'This post name is already exists',
                    ]
                ],
                'content' => [
                    'rules' => 'required|min_length[20]',
                    'errors' => [
                        'required' => 'Post content is required',
                        'min_length' => 'Post content must have atleast 20 characters',
                    ]
                ],
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Select post category',
                    ]
                ],
                'featured_image' => [
                    'rules' => 'uploaded[featured_image]|is_image[featured_image]|max_size[featured_image, 2048]',
                    'errors' => [
                        'uploaded' => 'Featured image is required',
                        'is_image' => 'Select an image file type',
                        'max_size' => 'Select image that not excess 2MB is size',
                    ]
                ],
            ]);

            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Validated....']);

                $user_id = CiAuth::id();
                $path = 'images/posts/';
                $file = $request->getFile('featured_image');
                $filename = $file->getClientName();

                // make post featured images folder is not exists
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }

                // uploade featured image
                if ($file->move($path, $filename)) {
                    // create thumb image
                    \Config\Services::image()
                        ->withFile($path . $filename)
                        ->fit(150, 150, 'center')
                        ->save($path . 'thumb_' . $filename);

                    // create resize image
                    \Config\Services::image()
                        ->withFile($path . $filename)
                        ->fit(500, 600, 'width')
                        ->save($path . 'resized_' . $filename);

                    // save new post details
                    $post = new Post();

                    $data = array(
                        'author_id' => $user_id,
                        'category_id' => $request->getVar('category'),
                        'title' => $request->getVar('title'),
                        'slug' => SlugService::model(Post::class)->make($request->getVar('title')),
                        'content' => $request->getVar('content'),
                        'featured_image' => $filename,
                        'tags' => $request->getVar('tags'),
                        'meta_keywords' => $request->getVar('meta_keywords'),
                        'meta_description' => $request->getVar('meta_description'),
                        'visibility' => $request->getVar('visibility'),
                    );

                    $save = $post->insert($data);
                    $last_id = $post->getInsertID();

                    if ($save) {
                        return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'New blog post has been successfully created.']);
                    } else {
                        return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong.']);
                    }
                } else {
                    return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Error on uploading featured image']);
                }
            }
        }
    }

    public function allPosts()
    {
        $data = [
            'pageTitle' => 'All posts'
        ];

        return view('backend/pages/all-posts', $data);
    }

    public function getPosts()
    {
        // DB details
        $dbDetails = array(
            "host" => $this->db->hostname,
            "user" => $this->db->username,
            "pass" => $this->db->password,
            "db" => $this->db->database
        );

        $table = "posts";
        $primaryKey = "id";
        $columns = array(
            array(
                "db" => "id",
                "dt" => 0
            ),
            array(
                "db" => "id",
                "dt" => 1,
                "formatter" => function ($d, $row) {
                    $post = new Post();
                    $image = $post->asObject()->find($row['id'])->featured_image;
                    return "<img src='/images/posts/thumb_$image' class='img-thumbnail' style='max-width:70px'>";
                }
            ),
            array(
                "db" => "title",
                "dt" => 2
            ),
            array(
                "db" => "id",
                "dt" => 3,
                "formatter" => function ($d, $row) {
                    $post = new Post();
                    $category_id = $post->asObject()->find($row['id'])->category_id;
                    $subcategory = new SubCategory();
                    $category_name = $subcategory->asObject()->find($category_id)->name;
                    return $category_name;
                }
            ),
            array(
                "db" => "id",
                "dt" => 4,
                "formatter" => function ($d, $row) {
                    $post = new Post();
                    $visibility = $post->asObject()->find($row['id'])->visibility;
                    return $visibility == 1 ? 'Public' : 'Private';
                }
            ),
            array(
                "db" => "id",
                "dt" => 5,
                "formatter" => function ($d, $row) {
                    return "<div class='btn-group'>
                        <a href='" . route_to('view-post', $row['id']) . "' class='btn btn-sm btn-link p-0 mx-1'>view</a>
                        <a href='" . route_to('edit-post', $row['id']) . "' class='btn btn-sm btn-link p-0 mx-1'>edit</a>
                        <button class='btn btn-sm btn-link p-0 mx-1 deletePostBtn' data-id='" . $row['id'] . "'>delete</button>
                    </div>";
                }
            ),
        );
        return json_encode(
            SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }

    public function editPost($id)
    {
        $subcategory = new SubCategory();
        $post = new Post();
        $data = [
            'pageTitle' => 'Edit post',
            'categories' => $subcategory->asObject()->findAll(),
            'post' => $post->asObject()->find($id),
        ];
        return view('backend/pages/edit-post', $data);
    }

    public function updatePost()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $post_id = $request->getVar('post_id');
            $user_id = CiAuth::id();
            $post = new Post();

            if (isset($_FILES['featured_image']['name']) && !empty($_FILES['featured_image']['name'])) {
                $this->validate([
                    'title' => [
                        'rules' => 'required|is_unique[posts.title,id,' . $post_id . ']',
                        'errors' => [
                            'required' => 'Post title is required',
                            'is_unique' => 'This post title is already exists'
                        ]
                    ],
                    'content' => [
                        'rules' => 'required|min_length[20]',
                        'errors' => [
                            'required' => 'Post content is required',
                            'min_length' => 'Post content must have atleast 20 characters'
                        ]
                    ],
                    'featured_image' => [
                        'rules' => 'uploaded[featured_image]|is_image[featured_image]|max_size[featured_image, 2048]',
                        'errors' => [
                            'uploaded' => 'A valid featured image is required',
                            'is_image' => 'select image file type',
                            'max_size' => 'Selected image is too big, Maximum size is 2MB'
                        ]
                    ]
                ]);
            } else {
                $this->validate([
                    'title' => [
                        'rules' => 'required|is_unique[posts.title,id,' . $post_id . ']',
                        'errors' => [
                            'required' => 'Post title is required',
                            'is_unique' => 'This post title is already exists'
                        ]
                    ],
                    'content' => [
                        'rules' => 'required|min_length[20]',
                        'errors' => [
                            'required' => 'Post content is required',
                            'min_length' => 'Post content must have atleast 20 characters'
                        ]
                    ],
                ]);
            }

            // run validation
            if ($validation->run() === FALSE) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'error' => $errors]);
            } else {
                // return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Validate....']);
                if (isset($_FILES['featured_image']['name']) && !empty($_FILES['featured_image']['name'])) {
                    $path = 'images/posts/';
                    $file = $request->getFile('featured_image');
                    $filename = $file->getClientName();
                    $old_post_featured_image = $post->asObject()->find($post_id)->featured_image;

                    // uploaded featured image
                    if ($file->move($path, $filename)) {
                        // create thumb image
                        \Config\Services::image()
                            ->withFile($path . $filename)
                            ->fit(150, 150, 'center')
                            ->save($path . 'thumb_' . $filename);

                        // create resized image
                        \Config\Services::image()
                            ->withFile($path . $filename)
                            ->fit(500, 600, true, 'width')
                            ->save($path . 'resized_' . $filename);

                        // delete old image
                        if ($old_post_featured_image != null && file_exists($path . $old_post_featured_image)) {
                            unlink($path . $old_post_featured_image);
                        }

                        if (file_exists($path . 'thumb_' . $old_post_featured_image)) {
                            unlink($path . 'thumb_' . $old_post_featured_image);
                        }

                        if (file_exists($path . 'resized_' . $old_post_featured_image)) {
                            unlink($path . 'resized_' . $old_post_featured_image);
                        }

                        // update post details in DB
                        $data = array(
                            'author_id' => $user_id,
                            'category_id' => $request->getVar('category'),
                            'title' => $request->getVar('title'),
                            'slug' => SlugService::model(Post::class)->make($request->getVar('title')),
                            'content' => $request->getVar('content'),
                            'featured_image' => $filename,
                            'tags' => $request->getVar('tags'),
                            'meta_keywords' => $request->getVar('meta_keywords'),
                            'meta_description' => $request->getVar('meta_description'),
                            'visibility' => $request->getVar('visibility'),
                        );
                        $update = $post->update($post_id, $data);
                        if ($update) {
                            return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Blog post has been successfully updated.']);
                        } else {
                            return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong.']);
                        }
                    } else {
                        return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Error on uploading featured image']);
                    }
                } else {
                    // update post details in DB
                    $data = array(
                        'author_id' => $user_id,
                        'category_id' => $request->getVar('category'),
                        'title' => $request->getVar('title'),
                        'slug' => SlugService::model(Post::class)->make($request->getVar('title')),
                        'content' => $request->getVar('content'),
                        'tags' => $request->getVar('tags'),
                        'meta_keywords' => $request->getVar('meta_keywords'),
                        'meta_description' => $request->getVar('meta_description'),
                        'visibility' => $request->getVar('visibility'),
                    );
                    $update = $post->update($post_id, $data);
                    if ($update) {
                        return $this->response->setJSON(['status' => 1, 'token' => csrf_hash(), 'msg' => 'Blog post has been successfully updated.']);
                    } else {
                        return $this->response->setJSON(['status' => 0, 'token' => csrf_hash(), 'msg' => 'Something went wrong.']);
                    }
                }
            }
        }
    }

    public function deletePost()
    {
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $path = 'images/posts/';
            $post_id = $request->getVar('post_id');
            $post = new Post();
            $postInfo = $post->asObject()->find($post_id);
            $post_featured_image = $postInfo->featured_image;

            // delete post image
            if ($post_featured_image != null && file_exists($path . $post_featured_image)) {
                unlink($path . $post_featured_image);
            }

            if (file_exists($path . 'thumb_' . $post_featured_image)) {
                unlink($path . 'thumb_' . $post_featured_image);
            }

            if (file_exists($path . 'resized_' . $post_featured_image)) {
                unlink($path . 'resized_' . $post_featured_image);
            }

            // delete post in DB
            $delete = $post->delete($post_id);

            if ($delete) {
                return $this->response->setJSON(['status' => 1, 'msg' => 'Good!. Post has been successfully deleted.']);
            } else {
                return $this->response->setJSON(['status' => 0, 'msg' => 'Something went wrong.']);
            }
        }
    }
}
