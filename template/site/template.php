<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        <?php page_title(); ?> |
            <?php site_name(); ?>
    </title>
    <link href="<?php site_url(); ?>/template/site/Style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="template/jquery-1.11.2.js"></script>
</head>
<body>
    <a id="topbt"></a>
    <div class="cinza">
        <div class="cinza2">
            <div class="cinza3">
                <a href="mall.site/home"><img src="imagens/site/button/img6.png"></a>
                <a href="https://www.facebook.com/mixmaster/"><img src="imagens/site/button/img7.png"></a>
            </div>
            <div class="cinza4">
                <marquee behavior="scroll" scrollamount="4" direction="right">
                    F2P MMORPG MixMaster - Faça o download do jogo gratis.
                </marquee>
            </div>
        </div>
    </div>
    <div class="top">
        <div class="direita">
        </div>
        <div class="float">
            <div class="login">
                <div class="login0">
                    <div class="login1">
                      <?php
                      if (isset($_SESSION['usuario'])){
                          echo '<a href="painel" class="classelink">Painel</a>' ;
                        }else{
                          echo '<a href="login" class="classelink">Login</a>';
                        }
                      ?>
                    </div>
                    <div class="login01"></div>
                    <div class="login2">
                      <?php
                      if (isset($_SESSION['usuario'])){
                          echo '<form method="post"><a href="painel" style="margin-left:-5px;" class="classelink"><button type="submit" class="resetform" id="logout" name="logout">Logout</button></a></form>' ;
                        }else{
                          echo '<a href="registro" class="classelink">Registro</a>';
                        }
                      ?>
                    </div>
                </div>
            </div>
            <div class="time">
                <div class="time2">
                    <font color='#09f'>
    <div class="txt"><div id="txt"></div></div>
    <?php
      echo utf8_encode(strftime('%A, %d de %B'));
    ?>
  </font>
                </div>
            </div>
        </div>
    </div>
    <div class="all">
        <div class="esquerda">
            <div class="esquerda2">
                <div class="login3">
                    <div class="login4">
                      <?php
                      if (isset($_SESSION['usuario'])){
                          echo '<a href="painel" class="classelink">Painel</a>' ;
                        }else{
                          echo '<a href="login" class="classelink">Login</a>';
                        }
                      ?>
                    </div>
                    <div class="login5">
                      <?php
                      if (isset($_SESSION['usuario'])){
                          echo '<form method="post"><a href="painel" style="margin-left:-5px;" class="classelink"><button type="submit" class="resetform" id="logout" name="logout">Logout</button></a></form>' ;
                        }else{
                          echo '<a href="registro" class="classelink">Reg</a>';
                        }
                      ?>
                    </div>
                </div>
                <div class="orange">
                    <div class="menu">
                        <ul id="nav">
                            <li>
                                <a href="home">
                                    <img src="imagens/site/button/img15.png" onmouseover="this.src='imagens/site/button/img9.png'" onMouseOut="this.src='imagens/site/button/img15.png'"></a>
                            </li>
                            <div class="menusep"></div>
                            <li>
                                <a href="novidades">
                                    <img src="imagens/site/button/img16.png" onmouseover="this.src='imagens/site/button/img10.png'" onMouseOut="this.src='imagens/site/button/img16.png'"></a>
                                <ul class="submenu">
                                  <div class="navmenu">
                                   <div class="navback">
                                     <div class="navbacktop">
                                       <table id="newnav" style="width:100%" border-spacing="0px" border-width="0px" border="0px" cellspacing="0px">
                                         <tr>
                                       <td><div class="navtext"><a id="navl" href="notas-de-atualizacao"><div id="fundo-texto"><div class="reddot"></div>Notas de Atualização</div></div></a><div class="navtextbreak"></div></td>
                                       </tr><tr>
                                       <td><div class="navtext"><a id="navl" href="eventos"><div id="fundo-texto"><div class="reddot"></div>Eventos</div></div></a></td>
                                       </tr>
                                       </table>
                                    </div>
                                    <div class="navbackbotton"> </div>
                                   </div>
                                  </div>
                               </ul>
                        </li>
                        <div class="menusep"></div>
                        <li>
                            <a href="guia">
                                <img src="imagens/site/button/img17.png" onmouseover="this.src='imagens/site/button/img11.png'" onMouseOut="this.src='imagens/site/button/img17.png'"></a>
                                <ul class="submenu">
                                <div class="navmenu">
                                 <div class="navback">
                                   <div class="navbacktop">
                                     <table id="newnav" style="width:100%" border-spacing="0px" border-width="0px" border="0px" cellspacing="0px">
                                       <tr>
                                      <td><div class="navtext"><a id="navl" href="conteudos-do-jogo"><div id="fundo-texto"><div class="reddot"></div>Conteudos do Jogo</div></div></a><div class="navtextbreak"></div></td>
                                     </tr><tr>
                                      <td><div class="navtext"><a id="navl" href="guia-do-iniciante"><div id="fundo-texto"><div class="reddot"></div>Guia do Iniciante</div></div></a><div class="navtextbreak"></div></td>
                                     </tr><tr>
                                     <td><div class="navtext"><a id="navl" href="como-instalar"><div id="fundo-texto"><div class="reddot"></div>Como Instalar</div></div></a></td>
                                    </tr>
                                     </table>
                                  </div>
                                  <div class="navbackbotton"> </div>
                                 </div>
                                </div>
                             </ul>
                        </li>
                        <div class="menusep"></div>
                        <li>
                            <a href="midia">
                                <img src="imagens/site/button/img18.png" onmouseover="this.src='imagens/site/button/img12.png'" onMouseOut="this.src='imagens/site/button/img18.png'"></a>
                                <ul class="submenu">
                                <div class="navmenu">
                                 <div class="navback">
                                   <div class="navbacktop">
                                     <table id="newnav" style="width:100%" border-spacing="0px" border-width="0px" border="0px" cellspacing="0px">
                                       <tr>
                                     <td><div class="navtext"><a id="navl" href="ranking"><div id="fundo-texto"><div class="reddot"></div>Ranking</div></div></a><div class="navtextbreak"></div></td>
                                     </tr><tr>
                                     <td><div class="navtext"><a id="navl" href="pesquisar-ranking"><div id="fundo-texto"><div class="reddot"></div>Pesquisar Ranking</div></div></a><div class="navtextbreak"></div></td>
                                     </tr><tr>
                                    <td><div class="navtext"><a id="navl" href="screenshots"><div id="fundo-texto"><div class="reddot"></div>Screenshots</div></div></a><div class="navtextbreak"></div></td>
                                  </tr><tr>
                                 <td><div class="navtext"><a id="navl" href="siege-affair"><div id="fundo-texto"><div class="reddot"></div>Siege Affair</div></div></a><div class="navtextbreak"></div></td>
                               </tr><tr>
                              <td><div class="navtext"><a id="navl" href="formulas"><div id="fundo-texto"><div class="reddot"></div>Formulas</div></div></a><div class="navtextbreak"></div></td>
                              </tr><tr>
                             <td><div class="navtext"><a id="navl" href="fan-sites"><div id="fundo-texto"><div class="reddot"></div>Fan Sites</div></a></td>
                             </tr>
                                     </table>
                                  </div>
                                  <div class="navbackbotton"> </div>
                                 </div>
                                </div>
                             </ul>
                        </li>
                        <div class="menusep"></div>
                        <li>
                            <a href="download">
                                <img src="imagens/site/button/img19.png" onmouseover="this.src='imagens/site/button/img13.png'" onMouseOut="this.src='imagens/site/button/img19.png'"></a>
                                  <ul class="submenu">
                                  <div class="navmenu">
                                   <div class="navback">
                                     <div class="navbacktop">
                                       <table id="newnav" style="width:100%" border-spacing="0px" border-width="0px" border="0px" cellspacing="0px">
                                         <tr>
                                       <td><div class="navtext"><a id="navl" href="download-do-jogo"><div id="fundo-texto"><div class="reddot"></div>Download do Jogo</div></div></a><div class="navtextbreak"></div></td>
                                       </tr><tr>
                                       <td><div class="navtext"><a id="navl" href="directx"><div id="fundo-texto"><div class="reddot"></div>DirectX</div></div></a><div class="navtextbreak"></div></td>
                                       </tr><tr>
                                      <td><div class="navtext"><a id="navl" href="wallpapers"><div id="fundo-texto"><div class="reddot"></div>Wallpapers</div></div></a><div class="navtextbreak"></div></td>
                                      </tr><tr>
                                      <td><div class="navtext"><a id="navl" href="videos"><div id="fundo-texto"><div class="reddot"></div>Videos</div></div></a><div class="navtextbreak"></div></td>
                                      </tr><tr>
                                        <td><div class="navtext"><a id="navl" href="fan-kit"><div id="fundo-texto"><div class="reddot"></div>Fan Kit</div></div></a></td>
                                        </tr>
                                       </table>
                                    </div>
                                    <div class="navbackbotton"> </div>
                                   </div>
                                  </div>
                               </ul>
                            </li>
                        <div class="menusep"></div>
                        <li>
                            <a href="suporte">
                                <img src="imagens/site/button/img20.png" onmouseover="this.src='imagens/site/button/img14.png'" onMouseOut="this.src='imagens/site/button/img20.png'"></a>
                                <ul class="submenu">
                                <div class="navmenu">
                                 <div class="navback">
                                   <div class="navbacktop">
                                     <table id="newnav" style="width:100%" border-spacing="0px" border-width="0px" border="0px" cellspacing="0px">
                                       <tr>
                                     <td><div class="navtext"><a id="navl" href="termos-de-uso"><div id="fundo-texto"><div class="reddot"></div>Termos de Uso</div></div></a><div class="navtextbreak"></div></td>
                                     </tr><tr>
                                     <td><div class="navtext"><a id="navl" href="faqs"><div id="fundo-texto"><div class="reddot"></div>FAQs</div></div></a></td>
                                     </tr>
                                     </table>
                                  </div>
                                  <div class="navbackbotton"> </div>
                                 </div>
                                </div>
                             </ul>
                </div>
            </div>
            <div class="orange2">
                <a href="mall.site/home"><img src="imagens/site/button/img3.png"></a>
            </div>
        </div>
    </div>
    <div class="meio">
        <div class="meioerror">
            <div class="meio2">
            </div>
            <div class="meio3">
                  <?php page_content(); ?>
            </div>
            <div class="finalwhite">
            </div>
        </div>
        <div class="prefooter"></div>
        <div class="footer">COPYRIGHT (C) <?php echo date('Y'); ?> MixMaster <?php site_version(); ?>. AuroraGames all rights reserved.</div>
    </div>
    <div class="direita1">
        <div class="direita2">
            <div class="direita3">
                <a href="midia"><img src="imagens/site/button/img4.png" width="98" height="146"></a>
                <div class="direitasep"></div>
                <a href="conteudos-do-jogo"><img src="imagens/site/button/img5.png" width="98" height="146"></a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>