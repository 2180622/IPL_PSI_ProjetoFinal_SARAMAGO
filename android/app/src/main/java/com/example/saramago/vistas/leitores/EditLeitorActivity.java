package com.example.saramago.vistas.leitores;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.os.Bundle;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.utils.LeitoresJsonParser;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

public class EditLeitorActivity extends AppCompatActivity implements DatePickerDialog.OnDateSetListener{

    private EditText nome, codBarras, nif, docId, dtaNascimento, morada, localidade, codPostal, telemovel, telefone, email, email2;
    private Leitor leitor;
    private final Date date = Calendar.getInstance().getTime();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_leitor);

        nome = findViewById(R.id.et_fl_nome);
        codBarras = findViewById(R.id.et_fl_codBarras);
        nif = findViewById(R.id.et_fl_nif);
        docId = findViewById(R.id.et_fl_docId);
        dtaNascimento = findViewById(R.id.et_fl_dataNasc);
        morada = findViewById(R.id.et_fl_morada);
        localidade = findViewById(R.id.et_fl_localidade);
        codPostal = findViewById(R.id.et_fl_codPostal);
        telemovel = findViewById(R.id.et_fl_telemovel);
        telefone = findViewById(R.id.tv_fl_telefone);
        email = findViewById(R.id.et_fl_email);
        email2 = findViewById(R.id.et_fl_email2);
        FloatingActionButton fabSave = findViewById(R.id.fabSave);

        if(leitor != null){
            carregarConteudoLeitor();
        }

        dtaNascimento.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                datePickerDialogShow();
            }
        });

        fabSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(LeitoresJsonParser.isConnectionInternet(getApplicationContext())) {
                    if (leitor != null) {
                        leitor.setNome(nome.getText().toString());
                        leitor.setCodBarras(nome.getText().toString());
                        leitor.setNif(Integer.parseInt(nome.getText().toString()));
                        leitor.setDocId(nome.getText().toString());
                        leitor.setDataNasc(nome.getText().toString());
                        leitor.setMorada(nome.getText().toString());
                        leitor.setLocalidade(nome.getText().toString());
                        leitor.setCodPostal(Integer.parseInt(nome.getText().toString()));
                        leitor.setTelemovel(Integer.parseInt(nome.getText().toString()));
                        leitor.setTelefone(Integer.parseInt(nome.getText().toString()));
                        leitor.setEmail(nome.getText().toString());
                        leitor.setMail2(nome.getText().toString());
                        leitor.setDataAtualizado(date.toString());

                        SingletonGestorBiblioteca.getInstance(getApplicationContext()).editarLeitorAPI(leitor, getApplicationContext());
                        setResult(RESULT_OK);
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), R.string.semInternet, Toast.LENGTH_LONG).show();
                    }
                }
            }
        });
    }

    private void datePickerDialogShow(){
        DatePickerDialog datePickerDialog = new DatePickerDialog(this,this,
                Calendar.getInstance().get(Calendar.YEAR),
                Calendar.getInstance().get(Calendar.MONTH),
                Calendar.getInstance().get(Calendar.DAY_OF_MONTH)
        );
        datePickerDialog.show();
    }

    @Override
    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
        String date = year + "/" + month + "/" + dayOfMonth;
        dtaNascimento.setText(date);
    }

    private void carregarConteudoLeitor(){
        nome.setText(leitor.getNome());
        codBarras.setText(leitor.getCodBarras());
        nif.setText(leitor.getNif()+"");
        docId.setText(leitor.getDocId());
        dtaNascimento.setText(leitor.getDataNasc());
        morada.setText(leitor.getMorada());
        localidade.setText(leitor.getLocalidade());
        codPostal.setText(leitor.getCodPostal()+"");
        telemovel.setText(leitor.getTelemovel()+"");
        telefone.setText(leitor.getTelefone()+"");
        email2.setText(leitor.getMail2());
    }
}