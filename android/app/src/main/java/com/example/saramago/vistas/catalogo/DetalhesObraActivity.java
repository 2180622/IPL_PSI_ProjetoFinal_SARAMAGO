package com.example.saramago.vistas.catalogo;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.viewpager2.widget.ViewPager2;

import com.example.saramago.R;
import com.example.saramago.adaptadores.catalogo.TabsObraAdaptador;
import com.example.saramago.modelos.Obra;
import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;

public class DetalhesObraActivity extends AppCompatActivity {

    public static final String ID = "ID";
    public Obra obra;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_obra);
        //para aparecer a seta <-- de voltar para tras
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        ViewPager2 viewPager2 = findViewById(R.id.pager);
        viewPager2.setAdapter(new TabsObraAdaptador(this));

        TabLayout tabLayout = findViewById(R.id.tabLayout);
        TabLayoutMediator tabLayoutMediator = new TabLayoutMediator(tabLayout, viewPager2, new TabLayoutMediator.TabConfigurationStrategy() {
            @Override
            public void onConfigureTab(@NonNull TabLayout.Tab tab, int position) {
                switch (position){
                    case 0:
                        tab.setIcon(R.drawable.ic_ficha_leitor);
                        break;
                    case 1:
                        tab.setIcon(R.drawable.ic_emprestimos_leitor);
                        break;
                }
            }
        });
        tabLayoutMediator.attach();
    }
}