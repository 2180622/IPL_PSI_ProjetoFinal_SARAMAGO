package com.example.saramago.vistas.catalogo.tabs;

import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.saramago.R;
import com.example.saramago.modelos.Obra;
import com.example.saramago.modelos.SingletonGestorBiblioteca;
import com.example.saramago.vistas.catalogo.EditObraActivity;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import static com.example.saramago.vistas.catalogo.DetalhesObraActivity.ID;

public class FichaObraFragment extends Fragment {
    private Obra obra;
    private TextView tv_titulo, tv_resumo, tv_editor, tv_ano, tv_tipoObra, tv_descricao, tv_local, tv_edicao, tv_preco, tv_assuntos, tv_dataRegisto, tv_dataAtualizado, tv_cdu_id, tv_colecao_id;

    public FichaObraFragment() {
        // Required empty public constructor
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_ficha_obra, container, false);

        int id = getActivity().getIntent().getIntExtra(ID, -1);
        obra = SingletonGestorBiblioteca.getInstance(getContext()).getObra(id);

        tv_titulo = view.findViewById(R.id.tv_fo_titulo);
        tv_resumo = view.findViewById(R.id.tv_fo_resumo);
        tv_editor = view.findViewById(R.id.tv_fo_editor);
        tv_ano = view.findViewById(R.id.tv_fo_ano);
        tv_tipoObra = view.findViewById(R.id.tv_fo_tipoObra);
        tv_descricao = view.findViewById(R.id.tv_fo_descricao);
        tv_local = view.findViewById(R.id.tv_fo_local);
        tv_edicao = view.findViewById(R.id.tv_fo_edicao);
        tv_assuntos = view.findViewById(R.id.tv_fo_assuntos);
        tv_preco = view.findViewById(R.id.tv_fo_preco);
        tv_dataRegisto = view.findViewById(R.id.tv_fo_dataRegisto);
        tv_dataAtualizado = view.findViewById(R.id.tv_fo_dataAtualizado);
        tv_cdu_id = view.findViewById(R.id.tv_fo_cdu_id);
        tv_colecao_id = view.findViewById(R.id.tv_fo_colecao_id);
        FloatingActionButton fabEditObra = view.findViewById(R.id.fabEditObra);

        fabEditObra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getContext(), EditObraActivity.class);
                startActivity(intent);
            }
        });

        if(obra != null){
            carregarConteudo();
        }

        return view;
    }

    private void carregarConteudo(){
        tv_titulo.setText(obra.getTitulo());
        tv_resumo.setText(obra.getResumo());
        tv_editor.setText(obra.getEditor());
        tv_ano.setText(obra.getAno()+"");
        tv_tipoObra.setText(obra.getTipoObra());
        tv_descricao.setText(obra.getDescricao());
        tv_local.setText(obra.getLocal());
        tv_edicao.setText(obra.getEdicao());
        tv_assuntos.setText(obra.getAssuntos());
        tv_preco.setText(obra.getPreco()+"");
        tv_dataRegisto.setText(obra.getDataRegisto());
        tv_dataAtualizado.setText(obra.getDataAtualizado());
        tv_cdu_id.setText(obra.getCdu_id()+"");
        tv_colecao_id.setText(obra.getColecao_id()+"");
    }
}