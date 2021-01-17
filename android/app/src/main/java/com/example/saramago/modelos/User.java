package com.example.saramago.modelos;

public class User {
    private int id, status, created_at, updated_at;
    private String username, auth_key, password_hash_, email;

    public User(int id, String username, String auth_key, String password_hash_, String email, int status, int created_at, int updated_at) {
        this.id = id;
        this.username = username;
        this.auth_key = auth_key;
        this.password_hash_ = password_hash_;
        this.email = email;
        this.status = status;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public String getUsername() { return username; }

    public void setUsername(String username) { this.username = username; }

    public String getPassword_hash_() { return password_hash_; }

    public void setPassword_hash_(String password_hash_) { this.password_hash_ = password_hash_; }

    public String getEmail() { return email; }

    public void setEmail(String email) { this.email = email; }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public int getCreated_at() {
        return created_at;
    }

    public void setCreated_at(int created_at) {
        this.created_at = created_at;
    }

    public int getUpdated_at() {
        return updated_at;
    }

    public void setUpdated_at(int updated_at) {
        this.updated_at = updated_at;
    }

    public String getAuth_key() {
        return auth_key;
    }

    public void setAuth_key(String auth_key) {
        this.auth_key = auth_key;
    }
}
