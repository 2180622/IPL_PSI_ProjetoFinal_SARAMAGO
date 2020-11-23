package com.example.saramago.modelos;

import android.content.Context;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class SingletonGestorBiblioteca {
    private static SingletonGestorBiblioteca instance = null;
    private ArrayList<Leitor> leitores;
    Date currentTime = Calendar.getInstance().getTime();

    public static synchronized SingletonGestorBiblioteca getInstance(Context context){
        if(instance == null){
            instance = new SingletonGestorBiblioteca(context);
        }
        return instance;
    }

    private SingletonGestorBiblioteca(Context context){
        gerarLeitores();
    }

    private void gerarLeitores(){
        // instanciar o array de livros
        leitores = new ArrayList<>();
        // Instanciar a classe Livro
        leitores.add(new Leitor(1,"1236885", 269745017, "123", currentTime, "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", currentTime, currentTime, 1, 1));
    }
    public ArrayList<Leitor> getLeitores(){
        return new ArrayList<>(leitores);
    }
    public Leitor getLeitor(int id)
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
    public void editarLeitor(Leitor leitor){
        Leitor l = getLeitor(leitor.getId());

        if(leitor != null){
            l.setCodBarras(leitor.getCodBarras());
            l.setNif(leitor.getNif());
            l.setDocId(leitor.getDocId());
            l.setDataNasc(leitor.getDataNasc());
            l.setMorada(leitor.getMorada());
            l.setLocalidade(leitor.getLocalidade());
            l.setCodPostal(leitor.getCodPostal());
            l.setTelemovel(leitor.getTelemovel());
            l.setTelefone(leitor.getTelefone());
            l.setEmail(leitor.getEmail());
            l.setMail2(leitor.getMail2());
            l.setDataRegisto(leitor.getDataRegisto());
            l.setDataAtualizado(leitor.getDataAtualizado());
        }
    }
    public void removerLeitor(int id){
        Leitor leitor = getLeitor(id);
        if(leitor != null){
            leitores.remove(leitor);
        }
    }

}
