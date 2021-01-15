package com.example.saramago.vistas;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.saramago.R;
import com.google.android.material.navigation.NavigationView;

public class MenuMainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    public static final String USERNAME = "USERNAME";
    public static final String NOME = "NOME";
    private NavigationView navigationView;
    private DrawerLayout drawer;
    private FragmentManager fragmentManager;
    private ImageView imgAvatar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);

        imgAvatar = findViewById(R.id.imgAvatar);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        navigationView = findViewById(R.id.nav_view);
        drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar, R.string.ndOpen, R.string.ndClose);
        toggle.syncState();
        drawer.addDrawerListener(toggle);
        navigationView.setNavigationItemSelectedListener(this);
        fragmentManager = getSupportFragmentManager();

        carregarCabecalho();
        carregarFragmentoInicial();
    }

    private void carregarCabecalho() {
        String username = "";

        username = getIntent().getStringExtra(USERNAME);
        View hview = navigationView.getHeaderView(0);
        TextView tv_email = hview.findViewById(R.id.tv_username);
        tv_email.setText(username);
    }

    private void carregarFragmentoInicial(){
        navigationView.setCheckedItem(R.id.nav_dashboard);
        Fragment fragment = new Dashboard();
        fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        Fragment fragment = null;

        switch (item.getItemId()) {
            case R.id.nav_dashboard:
                //System.out.println("-->Nav Estatico");
                fragment = new Dashboard();
                break;
            case R.id.tv_username:
                //System.out.println("-->Nav Dinamico");
            default:
                //System.out.println("-->Nav Estatico");
        }

        if (fragment != null)
            fragmentManager.beginTransaction().replace(R.id.contentFragment, fragment).commit();

        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}

/*
88BDBC - Azul Claro
FFFFFF - Branco
112D32 - Azul Super Escuro
4F4A41 - Laranja Terra (Escuro)
6E6658 - Cinzento Escuro
*/