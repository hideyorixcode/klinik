<?php namespace Config;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var array
     */
    public $ruleSets = [
        \CodeIgniter\Validation\Rules::class,
        \CodeIgniter\Validation\FormatRules::class,
        \CodeIgniter\Validation\FileRules::class,
        \CodeIgniter\Validation\CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------


    //RULES PENGGUNA
//    public $pengguna = [
//        'nama' => 'required',
//        'username' => 'required|is_unique[users.username]',
//        'password' => 'required|min_length[6]',
//        'confirm_password' => 'required|matches[password]',
//        'no_hp' => 'max_length[20]|numeric',
//        'level' => 'required',
//        'email' => 'required|valid_email|is_unique[users.email]',
//        'active' => 'required',
//        'avatar' => 'ext_in[avatar,png,jpg,gif,JPG,jpeg,JPEG]|max_size[avatar,1024]'
//    ];
//
//    public $pengguna_errors = [
//        'nama' => [
//            'required' => 'nama wajib diisi dan tidak boleh kosong',
//        ],
//        'username' => [
//            'required' => 'username wajib diisi dan tidak boleh kosong',
//            'is_unique' => 'username telah digunakan'
//        ],
//        'password' => [
//            'required' => 'password wajib diisi dan tidak boleh kosong',
//            'min_length' => 'Minimal 6 karakter'
//        ],
//        'confirm_password' => [
//            'required' => 'Konfirmasi password wajib diisi dan tidak boleh kosong',
//            'matches' => 'Konfirmasi password harus sama'
//        ],
//        'no_hp' => [
//            'numeric' => 'nomor hp harus berupa angka',
//            'max_length' => 'maksimal 20 karakter'
//        ],
//        'level' => [
//            'required' => 'Pilih Level',
//        ],
//        'email' => [
//            'required' => 'Email Wajib diisi dan tidak boleh kosong',
//            'is_unique' => 'email telah digunakan',
//            'valid_email' => 'Email yang anda input tidak valid'
//        ],
//        'active' => [
//            'required' => 'Pilih Status',
//        ],
//        'avatar' => [
//            'ext_in' => 'Tipe File Berupa Gambar',
//            'max_size' => 'Ukuran Maksimal Avatar / Foto 1 MB',
//
//        ]
//
//    ];
}
