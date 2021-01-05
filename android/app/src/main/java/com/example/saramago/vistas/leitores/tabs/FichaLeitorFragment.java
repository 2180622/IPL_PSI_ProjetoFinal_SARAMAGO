package com.example.saramago.vistas.leitores.tabs;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import org.w3c.dom.Text;

import static com.example.saramago.vistas.leitores.DetalhesLeitorActivity.ID;

public class FichaLeitorFragment extends Fragment {

    private Leitor leitor;
    private TextView nome, codBarras, nif, docId, dataNasc, morada, localidade, codPostal, telemovel, telefone, email, email2, dataRegisto, dataAtualizado, irregularidade;

    public FichaLeitorFragment() {
        // Required empty public constructor
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_ficha_leitor, container, false);

        int id = getActivity().getIntent().getIntExtra(ID, -1);
        leitor = SingletonGestorBiblioteca.getInstance(getContext()).getLeitor(id);

        nome = view.findViewById(R.id.tv_fl_nome);
        codBarras = view.findViewById(R.id.tv_fl_codBarras);
        nif = view.findViewById(R.id.tv_fl_nif);
        docId = view.findViewById(R.id.tv_fl_docId);
        dataNasc = view.findViewById(R.id.tv_fl_dataNasc);
        morada = view.findViewById(R.id.tv_fl_morada);
        localidade = view.findViewById(R.id.tv_fl_localidade);
        codPostal = view.findViewById(R.id.tv_fl_codPostal);
        telemovel = view.findViewById(R.id.tv_fl_telemovel);
        telefone = view.findViewById(R.id.tv_fl_telefone);
        email = view.findViewById(R.id.tv_fl_mail);
        email2 = view.findViewById(R.id.tv_fl_mail2);
        dataRegisto = view.findViewById(R.id.tv_fl_dtaRegisto);
        dataAtualizado = view.findViewById(R.id.tv_fl_dtaAtualizado);
        irregularidade = view.findViewById(R.id.tv_fl_irregularidade);


        if(leitor != null){
            carregarConteudo();
        }

        return view;
    }

    private void carregarConteudo(){
        nome.setText(leitor.getNome());
        codBarras.setText(leitor.getCodBarras());
        nif.setText(leitor.getNif()+"");
        docId.setText(leitor.getDocId());
        dataNasc.setText(leitor.getDataNasc());
        morada.setText(leitor.getMorada());
        localidade.setText(leitor.getLocalidade());
        codPostal.setText(leitor.getCodPostal()+"");
        telemovel.setText(leitor.getTelemovel()+"");
        telefone.setText(leitor.getTelefone()+"");
        email.setText(leitor.getEmail());
        email2.setText(leitor.getMail2());
        dataRegisto.setText(leitor.getDataRegisto()+"");
        dataAtualizado.setText(leitor.getDataAtualizado()+"");
        irregularidade.setText("Sem Irregularidades");
    }
}