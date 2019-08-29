<?php
require_once _model_ . "Role.php";
require_once _model_ . "Section.php";

class User
{
  private $_id,
    $_role,
    $_name,
    $_surname,
    $_mail,
    $_photo,
    $_login,
    $_password,
    $_reading,
    $_writing,

    $_logged = false,
    $_sections = array();

  public function __construct($id = 0)
  {
    $this->_id = $id;
    if ($this->_id > 0) {

      $sql = "SELECT * FROM users WHERE id_user = '" . $this->_id . "'";
      $users = Db::getInstance()->query($sql);

      if ($users->count() > 0) {
        $row = $users->result();
        $this->_role = new Role($row['id_role']);
        $this->_name = $row['name_user'];
        $this->_surname = $row['surname_user'];
        $this->_mail = $row['mail_user'];
        $this->_photo = $row['photo_user'];
        $this->_login = $row['login_user'];
        $this->_password = md5($row['password_user']);
        $this->_reading = $row['reading_user'];
        $this->_writing = $row['writing_user'];

        $sqls = "SELECT id_section FROM users_sections WHERE id_user = '" . $this->_id . "'";
        $sections = Db::getInstance()->query($sqls);

        if ($sections->count() > 0) {
          $rows = $sections->results();
          foreach ($rows as $row) {
            $this->_sections[] = new Section($row['id_section']);
          }
        }
      }
    }
  }

  public function getModules()
  {
    $modules = array();
    if (is_array($this->_sections) && count($this->_sections)) {
      foreach ($this->_sections as $key => $section) {
        if (is_object($section)) {
          if (!empty($section)) {
            $modules[] = $section->getModule();
          }
        }
      }
    }
    $modules = array_unique($modules);
    $modules = implode(",", $modules);
    return $modules;
  }

  public function getId()
  {
    return $this->_id;
  }

  public function getRole()
  {
    return $this->_role;
  }

  public function getName()
  {
    return $this->_name;
  }

  public function getSections()
  {
    return $this->_sections;
  }

  public function getSurname()
  {
    return $this->_surname;
  }

  public function getLoggedIn()
  {
    return $this->_logged;
  }

  public function setLoggedIn($status)
  {
    $this->_logged = $status;
  }

  public function getMail()
  {
    return $this->_mail;
  }

  public function getPhoto()
  {
    return $this->_photo;
  }

  public function setLogin()
  {
    return $this->_login;
  }

  public function getLogin()
  {
    return $this->_login;
  }

  public function getPassword()
  {
    return $this->_password;
  }

  public function getReading()
  {
    return $this->_reading;
  }

  public function getWriting()
  {
    return $this->_writing;
  }

  public function __toString()
  {
    return $this->_name . ' ' . $this->_surname;
  }
}
