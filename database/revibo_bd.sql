/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     2/4/2026 23:17:50                            */
/*==============================================================*/


drop index REALIZA_MUCHAS_FK;

drop index BUSQUEDA_PK;

drop table BUSQUEDA;

drop index TIENE_MUCHOS_FK;

drop index DEVICE_TOKENS_PK;

drop table DEVICE_TOKENS;

drop index GRAVEDAD_REPORTE_PK;

drop table GRAVEDAD_REPORTE;

drop index PERTENECE_A_UNA2_FK;

drop index INSTITUCION_PK;

drop table INSTITUCION;

drop index TIENE_UN_FK;

drop index NOTIFICACION_PK;

drop table NOTIFICACION;

drop index TIENE_UNA_FK;

drop index TIENEN_UN_FK;

drop index CREA_VARIOS_FK;

drop index REPORTE_PK;

drop table REPORTE;

drop index ROL_PK;

drop table ROL;

drop index GUARDA_MUCHAS_FK;

drop index RUTA_PK;

drop table RUTA;

drop index TIENE_VARIOS_FK;

drop index TIENE_VARIOS2_FK;

drop index TIENE_VARIOS_PK;

drop table TIENE_VARIOS;

drop index TIENE_VARI_S_FK;

drop index TIENE_VARI_S2_FK;

drop index TIENE_VARI_S_PK;

drop table TIENE_VARI_S;

drop index TIPO_NOTIFICACION_PK;

drop table TIPO_NOTIFICACION;

drop index TIPO_REPORTE_PK;

drop table TIPO_REPORTE;

drop index TIENE_MUCHAS_FK;

drop index URL_IMAGEN_REPORTE_PK;

drop table URL_IMAGEN_REPORTE;

drop index PERTENECE_A_UNA_FK;

drop index USUARIO_PK;

drop table USUARIO;

/*==============================================================*/
/* Table: BUSQUEDA                                              */
/*==============================================================*/
create table BUSQUEDA (
   ID_BUSQUEDA          SERIAL               not null,
   ID_USUARIO           INT4                 null,
   TEXTO_BUSQUEDA       VARCHAR(255)         null,
   LAT                  DECIMAL              null,
   LON                  DECIMAL              null,
   FECHA_CREACION       DATE                 null,
   constraint PK_BUSQUEDA primary key (ID_BUSQUEDA)
);

/*==============================================================*/
/* Index: BUSQUEDA_PK                                           */
/*==============================================================*/
create unique index BUSQUEDA_PK on BUSQUEDA (
ID_BUSQUEDA
);

/*==============================================================*/
/* Index: REALIZA_MUCHAS_FK                                     */
/*==============================================================*/
create  index REALIZA_MUCHAS_FK on BUSQUEDA (
ID_USUARIO
);

/*==============================================================*/
/* Table: DEVICE_TOKENS                                         */
/*==============================================================*/
create table DEVICE_TOKENS (
   ID_DEVICE_TOKEN      SERIAL               not null,
   ID_USUARIO           INT4                 null,
   TOKEN                TEXT                 null,
   PLATAFORMA           VARCHAR(100)         null,
   ACTIVO               BOOL                 null,
   FECHA_CREACION       DATE                 null,
   constraint PK_DEVICE_TOKENS primary key (ID_DEVICE_TOKEN)
);

/*==============================================================*/
/* Index: DEVICE_TOKENS_PK                                      */
/*==============================================================*/
create unique index DEVICE_TOKENS_PK on DEVICE_TOKENS (
ID_DEVICE_TOKEN
);

/*==============================================================*/
/* Index: TIENE_MUCHOS_FK                                       */
/*==============================================================*/
create  index TIENE_MUCHOS_FK on DEVICE_TOKENS (
ID_USUARIO
);

/*==============================================================*/
/* Table: GRAVEDAD_REPORTE                                      */
/*==============================================================*/
create table GRAVEDAD_REPORTE (
   ID_GRAVEDAD_REPORTE  SERIAL               not null,
   NOMBRE               VARCHAR(100)         null,
   DESCRIPCION          TEXT                 null,
   constraint PK_GRAVEDAD_REPORTE primary key (ID_GRAVEDAD_REPORTE)
);

/*==============================================================*/
/* Index: GRAVEDAD_REPORTE_PK                                   */
/*==============================================================*/
create unique index GRAVEDAD_REPORTE_PK on GRAVEDAD_REPORTE (
ID_GRAVEDAD_REPORTE
);

/*==============================================================*/
/* Table: INSTITUCION                                           */
/*==============================================================*/
create table INSTITUCION (
   ID_INSTITUCION       SERIAL               not null,
   ID_USUARIO           INT4                 null,
   NOMBRE               VARCHAR(100)         null,
   DESCRIPCION          TEXT                 null,
   FECHA_CREACION       DATE                 null,
   constraint PK_INSTITUCION primary key (ID_INSTITUCION)
);

/*==============================================================*/
/* Index: INSTITUCION_PK                                        */
/*==============================================================*/
create unique index INSTITUCION_PK on INSTITUCION (
ID_INSTITUCION
);

/*==============================================================*/
/* Index: PERTENECE_A_UNA2_FK                                   */
/*==============================================================*/
create  index PERTENECE_A_UNA2_FK on INSTITUCION (
ID_USUARIO
);

/*==============================================================*/
/* Table: NOTIFICACION                                          */
/*==============================================================*/
create table NOTIFICACION (
   ID_NOTIFICACION      SERIAL               not null,
   ID_TIPO_NOTIFICACION INT4                 null,
   TITULO               VARCHAR(255)         null,
   MENSAJE              TEXT                 null,
   LEIDO                BOOL                 null,
   FECHA_ENVIO          DATE                 null,
   FECHA_CREACION       DATE                 null,
   constraint PK_NOTIFICACION primary key (ID_NOTIFICACION)
);

/*==============================================================*/
/* Index: NOTIFICACION_PK                                       */
/*==============================================================*/
create unique index NOTIFICACION_PK on NOTIFICACION (
ID_NOTIFICACION
);

/*==============================================================*/
/* Index: TIENE_UN_FK                                           */
/*==============================================================*/
create  index TIENE_UN_FK on NOTIFICACION (
ID_TIPO_NOTIFICACION
);

/*==============================================================*/
/* Table: REPORTE                                               */
/*==============================================================*/
create table REPORTE (
   ID_REPORTE           SERIAL               not null,
   ID_USUARIO           INT4                 null,
   ID_TIPO_REPORTE      INT4                 null,
   ID_GRAVEDAD_REPORTE  INT4                 null,
   TITULO               VARCHAR(255)         null,
   DESCRIPCION          TEXT                 null,
   LATITUD              DECIMAL              null,
   LONGITUD             DECIMAL              null,
   ACTIVO               BOOL                 null,
   FECHA_INICIO         DATE                 null,
   FECHA_FIN            DATE                 null,
   FECHA_ACTUALIZACION  DATE                 null,
   constraint PK_REPORTE primary key (ID_REPORTE)
);

/*==============================================================*/
/* Index: REPORTE_PK                                            */
/*==============================================================*/
create unique index REPORTE_PK on REPORTE (
ID_REPORTE
);

/*==============================================================*/
/* Index: CREA_VARIOS_FK                                        */
/*==============================================================*/
create  index CREA_VARIOS_FK on REPORTE (
ID_USUARIO
);

/*==============================================================*/
/* Index: TIENEN_UN_FK                                          */
/*==============================================================*/
create  index TIENEN_UN_FK on REPORTE (
ID_TIPO_REPORTE
);

/*==============================================================*/
/* Index: TIENE_UNA_FK                                          */
/*==============================================================*/
create  index TIENE_UNA_FK on REPORTE (
ID_GRAVEDAD_REPORTE
);

/*==============================================================*/
/* Table: ROL                                                   */
/*==============================================================*/
create table ROL (
   ID_ROL               SERIAL               not null,
   NOMBRE               VARCHAR(100)         null,
   DESCRIPCION          TEXT                 null,
   constraint PK_ROL primary key (ID_ROL)
);

/*==============================================================*/
/* Index: ROL_PK                                                */
/*==============================================================*/
create unique index ROL_PK on ROL (
ID_ROL
);

/*==============================================================*/
/* Table: RUTA                                                  */
/*==============================================================*/
create table RUTA (
   ID_RUTA              SERIAL               not null,
   ID_USUARIO           INT4                 null,
   NOMBRE               VARCHAR(100)         null,
   ORIGEN_LAT           DECIMAL              null,
   ORIGEN_LONG          DECIMAL              null,
   DESTINO_LAT          DECIMAL              null,
   DESTINO_LONG         DECIMAL              null,
   POLYLINE             TEXT                 null,
   FECHA_ACTUALIZACION  DATE                 null,
   ACTIVA               BOOL                 null,
   constraint PK_RUTA primary key (ID_RUTA)
);

/*==============================================================*/
/* Index: RUTA_PK                                               */
/*==============================================================*/
create unique index RUTA_PK on RUTA (
ID_RUTA
);

/*==============================================================*/
/* Index: GUARDA_MUCHAS_FK                                      */
/*==============================================================*/
create  index GUARDA_MUCHAS_FK on RUTA (
ID_USUARIO
);

/*==============================================================*/
/* Table: TIENE_VARIOS                                          */
/*==============================================================*/
create table TIENE_VARIOS (
   ID_ROL               INT4                 not null,
   ID_USUARIO           INT4                 not null,
   constraint PK_TIENE_VARIOS primary key (ID_ROL, ID_USUARIO)
);

/*==============================================================*/
/* Index: TIENE_VARIOS_PK                                       */
/*==============================================================*/
create unique index TIENE_VARIOS_PK on TIENE_VARIOS (
ID_ROL,
ID_USUARIO
);

/*==============================================================*/
/* Index: TIENE_VARIOS2_FK                                      */
/*==============================================================*/
create  index TIENE_VARIOS2_FK on TIENE_VARIOS (
ID_USUARIO
);

/*==============================================================*/
/* Index: TIENE_VARIOS_FK                                       */
/*==============================================================*/
create  index TIENE_VARIOS_FK on TIENE_VARIOS (
ID_ROL
);

/*==============================================================*/
/* Table: TIENE_VARI_S                                          */
/*==============================================================*/
create table TIENE_VARI_S (
   ID_USUARIO           INT4                 not null,
   ID_NOTIFICACION      INT4                 not null,
   constraint PK_TIENE_VARI_S primary key (ID_USUARIO, ID_NOTIFICACION)
);

/*==============================================================*/
/* Index: TIENE_VARI_S_PK                                       */
/*==============================================================*/
create unique index TIENE_VARI_S_PK on TIENE_VARI_S (
ID_USUARIO,
ID_NOTIFICACION
);

/*==============================================================*/
/* Index: TIENE_VARI_S2_FK                                      */
/*==============================================================*/
create  index TIENE_VARI_S2_FK on TIENE_VARI_S (
ID_NOTIFICACION
);

/*==============================================================*/
/* Index: TIENE_VARI_S_FK                                       */
/*==============================================================*/
create  index TIENE_VARI_S_FK on TIENE_VARI_S (
ID_USUARIO
);

/*==============================================================*/
/* Table: TIPO_NOTIFICACION                                     */
/*==============================================================*/
create table TIPO_NOTIFICACION (
   ID_TIPO_NOTIFICACION SERIAL               not null,
   NOMBRE               VARCHAR(100)         null,
   DESCRIPCION          TEXT                 null,
   constraint PK_TIPO_NOTIFICACION primary key (ID_TIPO_NOTIFICACION)
);

/*==============================================================*/
/* Index: TIPO_NOTIFICACION_PK                                  */
/*==============================================================*/
create unique index TIPO_NOTIFICACION_PK on TIPO_NOTIFICACION (
ID_TIPO_NOTIFICACION
);

/*==============================================================*/
/* Table: TIPO_REPORTE                                          */
/*==============================================================*/
create table TIPO_REPORTE (
   ID_TIPO_REPORTE      SERIAL               not null,
   NOMBRE               VARCHAR(100)         null,
   DESCRIPCION          TEXT                 null,
   constraint PK_TIPO_REPORTE primary key (ID_TIPO_REPORTE)
);

/*==============================================================*/
/* Index: TIPO_REPORTE_PK                                       */
/*==============================================================*/
create unique index TIPO_REPORTE_PK on TIPO_REPORTE (
ID_TIPO_REPORTE
);

/*==============================================================*/
/* Table: URL_IMAGEN_REPORTE                                    */
/*==============================================================*/
create table URL_IMAGEN_REPORTE (
   ID_URL_IMAGEN        SERIAL               not null,
   ID_REPORTE           INT4                 null,
   URL_IMAGEN           TEXT                 null,
   constraint PK_URL_IMAGEN_REPORTE primary key (ID_URL_IMAGEN)
);

/*==============================================================*/
/* Index: URL_IMAGEN_REPORTE_PK                                 */
/*==============================================================*/
create unique index URL_IMAGEN_REPORTE_PK on URL_IMAGEN_REPORTE (
ID_URL_IMAGEN
);

/*==============================================================*/
/* Index: TIENE_MUCHAS_FK                                       */
/*==============================================================*/
create  index TIENE_MUCHAS_FK on URL_IMAGEN_REPORTE (
ID_REPORTE
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO (
   ID_USUARIO           SERIAL               not null,
   ID_INSTITUCION       INT4                 null,
   NOMBRE               VARCHAR(100)         null,
   CORREO               VARCHAR(255)         null,
   PASSWORD             TEXT                 null,
   ESTADO               BOOL                 null,
   FECHA_CREACION       DATE                 null,
   constraint PK_USUARIO primary key (ID_USUARIO)
);

/*==============================================================*/
/* Index: USUARIO_PK                                            */
/*==============================================================*/
create unique index USUARIO_PK on USUARIO (
ID_USUARIO
);

/*==============================================================*/
/* Index: PERTENECE_A_UNA_FK                                    */
/*==============================================================*/
create  index PERTENECE_A_UNA_FK on USUARIO (
ID_INSTITUCION
);

alter table BUSQUEDA
   add constraint FK_BUSQUEDA_REALIZA_M_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table DEVICE_TOKENS
   add constraint FK_DEVICE_T_TIENE_MUC_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table INSTITUCION
   add constraint FK_INSTITUC_PERTENECE_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table NOTIFICACION
   add constraint FK_NOTIFICA_TIENE_UN_TIPO_NOT foreign key (ID_TIPO_NOTIFICACION)
      references TIPO_NOTIFICACION (ID_TIPO_NOTIFICACION)
      on delete restrict on update restrict;

alter table REPORTE
   add constraint FK_REPORTE_CREA_VARI_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table REPORTE
   add constraint FK_REPORTE_TIENEN_UN_TIPO_REP foreign key (ID_TIPO_REPORTE)
      references TIPO_REPORTE (ID_TIPO_REPORTE)
      on delete restrict on update restrict;

alter table REPORTE
   add constraint FK_REPORTE_TIENE_UNA_GRAVEDAD foreign key (ID_GRAVEDAD_REPORTE)
      references GRAVEDAD_REPORTE (ID_GRAVEDAD_REPORTE)
      on delete restrict on update restrict;

alter table RUTA
   add constraint FK_RUTA_GUARDA_MU_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table TIENE_VARIOS
   add constraint FK_TIENE_VA_TIENE_VAR_ROL foreign key (ID_ROL)
      references ROL (ID_ROL)
      on delete restrict on update restrict;

alter table TIENE_VARIOS
   add constraint FK_TIENE_VA_TIENE_VAR_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table TIENE_VARI_S
   add constraint FK_TIENE_VA_TIENE_VAR_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on delete restrict on update restrict;

alter table TIENE_VARI_S
   add constraint FK_TIENE_VA_TIENE_VAR_NOTIFICA foreign key (ID_NOTIFICACION)
      references NOTIFICACION (ID_NOTIFICACION)
      on delete restrict on update restrict;

alter table URL_IMAGEN_REPORTE
   add constraint FK_URL_IMAG_TIENE_MUC_REPORTE foreign key (ID_REPORTE)
      references REPORTE (ID_REPORTE)
      on delete restrict on update restrict;

alter table USUARIO
   add constraint FK_USUARIO_PERTENECE_INSTITUC foreign key (ID_INSTITUCION)
      references INSTITUCION (ID_INSTITUCION)
      on delete restrict on update restrict;

