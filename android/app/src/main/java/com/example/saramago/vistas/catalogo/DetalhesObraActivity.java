package com.example.saramago.vistas.catalogo;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.viewpager2.widget.ViewPager2;

import com.example.saramago.R;
import com.example.saramago.adaptadores.catalogo.TabsObraAdaptador;
import com.example.saramago.modelos.Obra;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.ObrasJsonParser;
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

        int id = getIntent().getIntExtra(ID, -1);
        obra = SingletonGestorBiblioteca.getInstance(getApplicationContext()).getObra(id);

        ViewPager2 viewPager2 = findViewById(R.id.pager);
        viewPager2.setAdapter(new TabsObraAdaptador(this));

        setTitle(obra.getTitulo());

        TabLayout tabLayout = findViewById(R.id.tabLayout);
        TabLayoutMediator tabLayoutMediator = new TabLayoutMediator(tabLayout, viewPager2, new TabLayoutMediator.TabConfigurationStrategy() {
            @Override
            public void onConfigureTab(@NonNull TabLayout.Tab tab, int position) {
                switch (position){
                    case 0:
                        tab.setIcon(R.drawable.ic_undraw_books);
                        break;
                    case 1:
                        tab.setIcon(R.drawable.ic_undraw_bookshelves);
                        break;
                }
            }
        });
        tabLayoutMediator.attach();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater menuInflater=getMenuInflater();

        menuInflater.inflate(R.menu.menu_detalhesobra_drawer,menu);

        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) { //https://stackoverflow.com/questions/24032956/action-bar-back-button-not-working/24033351
        switch (item.getItemId()){
            case android.R.id.home:
                onBackPressed();
                return true;
            case R.id.itemRemover:
                if(ObrasJsonParser.isConnectionInternet(getApplicationContext()))
                    dialogRemover();
                else
                    Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_SHORT).show();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void dialogRemover() {
        AlertDialog.Builder builder;
        builder= new AlertDialog.Builder(this);
        builder.setTitle("Remover Obra")
                .setMessage("Pretende mesmo remover a obra?")
                .setPositiveButton(R.string.respostaSim, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        SingletonGestorBiblioteca.getInstance(getApplicationContext()).removerObraAPI(obra, getApplicationContext());
                        setResult(RESULT_OK);
                        Intent intent = new Intent(DetalhesObraActivity.this, ListaObrasActivity.class);
                        startActivity(intent);
                        finish();
                    }
                })
                .setNegativeButton(R.string.respostaNao, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                    }
                })
                .setIcon(android.R.drawable.ic_delete)
                .show();
    }
}