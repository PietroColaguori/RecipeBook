PGDMP     (    /                {        	   ForkMates    15.2    15.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16467 	   ForkMates    DATABASE     ~   CREATE DATABASE "ForkMates" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "ForkMates";
                postgres    false            �            1259    16468    utenti    TABLE     �   CREATE TABLE public.utenti (
    username character varying(20),
    email character varying(40) NOT NULL,
    pswd character varying(60) NOT NULL
);
    DROP TABLE public.utenti;
       public         heap    postgres    false            �          0    16468    utenti 
   TABLE DATA           7   COPY public.utenti (username, email, pswd) FROM stdin;
    public          postgres    false    214   d       e           2606    16472    utenti utenti_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.utenti
    ADD CONSTRAINT utenti_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.utenti DROP CONSTRAINT utenti_pkey;
       public            postgres    false    214            �   �   x�e�Mo�0 ��3���W��&"Sa�|j�0(Pl)�k2��u�e�n�{y��0�߰��oɇ�=�	�g�n/�e��i4�1[��Ĭ<�"�,*��-k��{A�<wd�,S	�
p��?j8����t�!F�N�^Uh��q��k�E�h~��\ZոY���lZ˖�fZ��u�>��p�S��",\�K	��Ju��Q?p"�����o?xY��2,� �H�]     