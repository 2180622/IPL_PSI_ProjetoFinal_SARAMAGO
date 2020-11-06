package com.example.saramago;

import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.FragmentManager;

import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.google.android.material.navigation.NavigationView;

public class MenuMainActivity extends AppCompatActivity {

    public static final String EMAIL = "EMAIL";
    private NavigationView navigationView;
    private DrawerLayout drawer;
    private FragmentManager fragmentManager;
    private ImageView imgUser;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        navigationView = findViewById(R.id.nav_view);
        drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.ndOpen, R.string.ndClose);

        toggle.syncState();
        drawer.addDrawerListener(toggle);
        //navigationView.setNavigationItemSelectedListener(this);
        fragmentManager = getSupportFragmentManager();

        carregarCabecalho();
    }

    private void carregarCabecalho() {
        String email = "";
        String nome = "";

        email = getIntent().getStringExtra(EMAIL);
        View hview = navigationView.getHeaderView(0);
        TextView tv_nome = hview.findViewById(R.id.tvNome);
        tv_nome.setText(nome);
        TextView tv_email = hview.findViewById(R.id.tvEmail);
        tv_email.setText(email);
    }
}

/*
88BDBC - Azul Claro
FFFFFF - Branco
112D32 - Azul Super Escuro
4F4A41 - Laranja Terra (Escuro)
6E6658 - Cinzento Escuro
*/