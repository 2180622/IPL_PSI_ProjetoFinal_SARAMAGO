package com.example.saramago.modelos;

import com.example.saramago.R;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class SingletonGestorLeitores {
    private static SingletonGestorLeitores instance = null;
    private ArrayList<Leitor> leitores;
    Date currentTime = Calendar.getInstance().getTime();

    public static synchronized SingletonGestorLeitores getInstance(){
        if(instance == null){
            instance = new SingletonGestorLeitores();
        }
        return instance;
    }

    public ArrayList<Leitor> getLeitores(){
        return new ArrayList<>(leitores);
    }

    private void gerarLeitor(){
        // instanciar o array de livros
        leitores = new ArrayList<>();
        // Instanciar a classe Livro
        Leitor leitor = new Leitor(1,"1236885", 269745017, "123", currentTime, "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", currentTime, currentTime, 1, 1);
        leitores.add(leitor);
    }

    public Leitor getLeitores(int id)
    {
        for(Leitor leitor: leitores)
        {
            if(leitor.getId()==id)
            {
                return leitor;
            }
        }
        return null;
    }

    public void adicionarLeitor(Leitor livro){
        leitores.add(livro);
    }

    public void editarLeitor(Leitor livro){
        Leitor leitor = getLeitores(livro.getId());

        if(leitor != null){
            leitor.setCodBarras(livro.getCodBarras());
            leitor.setNif(livro.getNif());
            leitor.setDocId(livro.getDocId());
            leitor.setDataNasc(livro.getDataNasc());
            leitor.setMorada(leitor.getMorada());
            leitor.setLocalidade(leitor.getLocalidade());
            leitor.setCodPostal(leitor.getCodPostal());
            leitor.setTelemovel(leitor.getTelemovel());
            leitor.setTelefone(leitor.getTelefone());
            leitor.setEmail(leitor.getEmail());
            leitor.setMail2(leitor.getMail2());
            leitor.setDataRegisto(leitor.getDataRegisto());
            leitor.setDataAtualizado(leitor.getDataAtualizado());
        }
    }


    public void removerLeitor(int id){
        Leitor leitor = getLeitores(id);
        if(leitor != null){
            leitores.remove(leitor);
        }
    }

}
