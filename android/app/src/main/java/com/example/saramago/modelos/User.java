package com.example.saramago.modelos;

public class User {
    private int id;
    private String username,  password_hash_, email;

    public User(int id, String username, String password_hash_, String email) {
        this.id = id;
        this.username = username;
        this.password_hash_ = password_hash_;
        this.email = email;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public String getUsername() { return username; }

    public void setUsername(String username) { this.username = username; }

    public String getPassword_hash_() { return password_hash_; }

    public void setPassword_hash_(String password_hash_) { this.password_hash_ = password_hash_; }

    public String getEmail() { return email; }

    public void setEmail(String email) { this.email = email; }
}
