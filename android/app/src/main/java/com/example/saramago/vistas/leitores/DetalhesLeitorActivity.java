package com.example.saramago.vistas.leitores;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.viewpager2.widget.ViewPager2;

import android.os.Bundle;
import android.view.MenuItem;

import com.example.saramago.R;
import com.example.saramago.adaptadores.leitores.TabsLeitorAdaptador;
import com.example.saramago.modelos.Leitor;
import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;

public class DetalhesLeitorActivity extends AppCompatActivity {

    public static final String ID = "ID";
    public Leitor leitor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_leitor);
        //para aparecer a seta <-- de voltar para tras
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        ViewPager2 viewPager2 = findViewById(R.id.pager);
        viewPager2.setAdapter(new TabsLeitorAdaptador(this));

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
                    case 2:
                        tab.setIcon(R.drawable.ic_reservas_leitor);
                        break;
                    case 3:
                        tab.setIcon(R.drawable.ic_reprografia_leitor);
                        break;
                }
            }
        });
        tabLayoutMediator.attach();
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) { //https://stackoverflow.com/questions/24032956/action-bar-back-button-not-working/24033351
        switch (item.getItemId()){
            case android.R.id.home:
                onBackPressed();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }
}