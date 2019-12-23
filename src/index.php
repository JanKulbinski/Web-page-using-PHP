<?php include('server.php');
addVisitor();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/
tex-mml-chtml.js"></script>
    <link rel="stylesheet" type="text/css" href="mycss.css?version=1" />

</head>


<body text="white">

    <header>
	<?php include('errors.php'); ?>
        <h1>Zakamarki kryptografi</h1>
        <h2><a href="#Alg1">Algorytm szyfrowania probabilistycznego Goldwasser-Micali</a></h2>
        <br>
        <h2><a href="#Alg2">Schemat progowy dzielenia sekretu Shamira</a></h2>
		<h6>Strona odwiedzona <?php echo $numberOfVisits; ?> razy.</h6>
		<div class="buttons">
		
		<?php if(isset($_SESSION['login']) && $_SESSION['login']) {
			echo "<form method='post' action=''> <div class='input-group'>
				<button type='submit' class='btn' name='log_out'>Wyloguj się</button> </div> </form>";
			} else {
				echo '<div classs="block"><a id="signIn" onclick="login()">Zaloguj się</a><div>';	
			}
		?>
		
		<a id="signUp">Zarestruj się</a>
		</div>
    </header>

    <main>
        <section id="Alg1">
                <h2>Schemat Goldwasser-Micali szyfrowania probabilistycznego </h2>
                <h3>Algorytm generowania kluczy</h3>
                <ol type="1">
                    <li>
                        Wybierz losowo dwie duze liczby pierwsze <i>p</i> oraz <i>q</i> (podobnego rozmiaru),
                    </li>
                    <li>
                        Policz <i>n = pq,</i>
                    </li>
                    <li>
                        Wybierz \(y\in\,\mathbb{Z}_n\), takie, że <i>y</i> jest nieresztą kwadratową modulo <i>n</i> i symbol Jacobiego \((\frac y n) = 1\) (czyli <i>y</i> jest pseudokwadratem modulo <i>n</i>)
                    </li>
                    <li>
                        Klucz publiczny stanowi para (<i>n, y</i>), zaś odpowiadający mu klucz prywatny to para (<i>p, q</i>)
                    </li>
                </ol>
                <h3>Algorytm szyfrowania</h3>
                <p>
                    Chcąc zaszyfrować wiadomość <i>m</i> przy uzyciu klucza publicznego (<i>n, y</i>) wykonaj kroki:
                </p>
                <ol type="1">
                    <li>
                        Przedstaw <i>m</i> w postaci łańcucha binarnego <i>\(m = m_1m_2....m_t\)</i> długości <i>t</i>
                    </li>
                    <li>
                        <span class="mono">For</span><span class="mono"> i from </span>1<span class="mono"> to </span>t <span class="mono">do</span>
                        <br><span class="mono tab">wybierz losowe</span> \(x\in\,\mathbb{Z}_n^*\)
                        <br><span class="mono tab">If m_i = </span>1 <span class="mono">then set </span><span>\(c_i\leftarrow y x^2\,mod\,n\)</span>
                        <br><span class="mono tab">Otherwise set </span><span>\(c_i\leftarrow x^2\,mod\,n\)</span>
                    </li>
                    <li>
                        Zdeszyfrowana wiadomość to <i>m</i> stanowi \(c = (c_1,c_2...,c_t)\)
                    </li>
                </ol>
                <h3>Algorytm deszyfrowania</h3>
                <p>Chcąc odzyskać wiadomość z kryptogramu <i>c</i> przy użyciu klucza prywatnego (<i>p,q</i>) wykonaj kroki:</p>
                <ol type="1">
                    <li>
                        <span class="mono">For</span><span class="mono"> i from </span>1<span class="mono"> to </span>t <span class="mono">do</span>
                        <br><span class="mono tab">policz symbol Legendre'a </span> \(e_i = (\frac {c_i} p)\) <span><a href="#sl">(algorytm niżej)</a></span>
                        <br><span class="mono tab">If e_i = </span>1 <span class="mono">then set </span><span>\(m_i\leftarrow 0\)</span>
                        <br><span class="mono tab">Otherwise set </span><span>\(m_i\leftarrow 1\)</span>
                    </li>
                    <li>
                        Zdeszyfrowana wiadomość to <i>\(m = m_1m_2....m_t\)</i>
                    </li>
                </ol>
				<?php include('comments.php');
						readComments(1);
					?>
		</section>		
		
		<section id="Alg2">			
                <h2>Reszta/niereszta kwadratowa</h2>
                <p><b>Definicja.</b> Niech \(a \in\,\mathbb{Z}_n.\) Mówimy, że <i>a </i>jest resztą kwadratową modulo
                    <i>n</i> (kwadratem modulo <i>n</i>), jeżeli istnieje \(x \in\,\mathbb{Z}_n\) takie, że \( x^2 \equiv a\) (mod p). Jeżeli takie x nie istnieje, to wówczas <i>a</i> nazywamy nieresztą kwadratową modulo <i>n</i>. Zbiór wszystkich reszt
                    kwadratowych modulo <i>n</i> oznaczamy \(Q_n\), zaś zbiór wszystkich niereszt kwadratowych modulo <i>n</i> oznaczamy \(\overline{Q}_n\).</p>

                <h2 id="sl">Symbol Legendre’a i Jacobiego</h2>
                <p><b>Definicja.</b> Niech <i>p</i> będzie nieparzystą liczbą pierwszą, a <i>a</i> liczbą całkowitą.<br>
                    <i class="tab"> Symbol Legendre'a \((\frac a p)\)</i> jest zdefiniowany jako:<br> $$ \bigg(\frac a p \bigg) = \left\{\begin{array}{rl} 0 & \textrm{ jeżeli } p|a\\ 1 & \textrm{ jeżeli } a\in Q_p\\ -1 & \textrm{ jeżeli } a\in \overline{Q}_p
                    \end{array}\right. $$
                </p>
                <p>
                    <b>Własności symbolu Legendre’a.</b> Niech <i>a, b </i>\(\in\,\mathbb{Z}\), zaś <i>p</i> to nieparzysta liczba pierwsza. Wówczas:
                </p>
                <ul>
                    <li> \(\frac a p \equiv a^{\frac{(p-1)} 2} \textrm{(mod p)}\)</li>
                    <li>\((\frac {ab} p) = (\frac a p) (\frac b p) \)</li>
                    <li>\(a \equiv b \, \textrm{(mod p)} \Longrightarrow (\frac a p) = (\frac b p) \)</li>
                    <li>\(\frac 2 p = (-1)^{\frac {(p^2 - 1)} 8}\)</li>
                    <li>Jeżeli <i>q</i> jest nieparzystą liczbą pierwszą inną od <i>p</i> to: <br> \((\frac p q) = (\frac q p)(-1)^{\frac {(p - 1)(q - 1)} 4}\)
                    </li>
                </ul>
                <p><b>Definicja.</b> Niech <i>n</i>\(\,\geqslant 3 \) będzie liczbą nieparzystą a jej rozkład na czynniki pierwsze to \( n = p_1^{e_1}p_2^{e_2}...p_k^{e_k}\)<i>. Symbol Jacobiego </i> \( (\frac a n) \) jest zdefiniowany jako:<br></p>
                $$\bigg(\frac a n \bigg) = \bigg(\frac a {p_1}\bigg)^{e_1} \bigg(\frac a {p_2}\bigg)^{e_2} \, \textrm{...} \, \bigg(\frac a {p_k}\bigg)^{e_k}$$
                <p>Jeżeli <i>n</i> jest liczbą pierwszą, to symbol Jacobieo jest symbolem Legendre’a</p>
                <p><b>Własności symbolu Jacobiego.</b> Niech <i>a, b </i>\(\in\,\mathbb{Z}\) zaś <i>m,n</i> \(\geqslant 3\) to nieparzyste liczby całkowite. Wówczas:</p>
                <ul>
                    <li>\( (\frac a b\)) = 0, 1, albo - 1. Ponadto \((\frac a n) = 0 \iff\) ged(a,n) \(\neq\) 1</li>
                    <li>\( (\frac {ab} n\)) = \( (\frac a n\)) \( (\frac b n\))</li>
                    <li>\( (\frac {a} {nm}\)) = \( (\frac a m\)) \( (\frac a n\))</li>
                    <li>\( a \equiv b\) (mod n) \( \Rightarrow (\frac a n\)) = \( (\frac b n\))</li>
                    <li>\( (\frac {1} n\)) = 1</li>
                    <li>\( (\frac {-1} n) = (-1)^{\frac {(n-1)} 2} \)</li>
                    <li>\( (\frac 2 n) = (-1)^{\frac {(n^2-1)} 8} \)</li>
                    <li>\( (\frac m n) = (\frac n m ) (-1)^{\frac {(n-1)(m-1)} 4} \)</li>
                </ul>
                <p id= "Jaco">Z własności symbolu Jacobiego wynika, że jeżeli <i>n</i> nieparzyste oraz <i>a</i> nieparzyste i w postaci a = \(2^ea_1\), gdzie \(a_1\) też nieparzyste, to:</p>
                $$\bigg(\frac a n\bigg) = \bigg(\frac {2^e} n\bigg) \bigg(\frac {a_1} n\bigg) = \bigg(\frac 2 n\bigg)^e \bigg(\frac {n\,mod\,a_1} {a_1}\bigg) (-1)^{\frac {(a_1 - 1)(n - 1)} 4}$$
                <p><b>Algorytm obliczania symbolu Jacobiego</b>\((\frac a n)\)<b>(i Legendre’a)</b> dla nieparzystej liczby całkowitej n \(\geqslant\) 3 oraz całkowitego 0 \(\leqslant \) a \(
                    <\) n </p>
                        <div class="container">
                            <p class="mono"> JACOBI </p>(a,n)
                        </div>
                        <ol type="a">
                            <li class="container">
                                <p class="mono">If a = 0 then return 0</p>
                            </li>
                            <li class="container">
                                <p class="mono">If a = 1 then return 1</p>
                            </li>
                            <li class="container">
                                <p class="mono">Write a = </p>\(2^ea_1\),
                                <p class="mono"> gdzie </p>\(a_1\)
                                <p class="mono">nieparzyste</p>
                            </li>
                            <li class="container">
                                <p class="mono">If e parzyste set s </p>\(\leftarrow\)</p>
                <p class="mono">1</p><br>
                <p class="mono tab">Otherwise set s \(\leftarrow\) 1 if n \(\equiv\)</p>
                <p class="mono">or 7 (mod 8), or set s
                </p>\(\leftarrow \)
                <p class="mono">-1 if n </p> \(\equiv\)
                <p class="mono">3 or 5 (mod 8)</p>
                </li>
                <li class="container">
                    <p class="mono">If n \(\equiv\) 3 (mod 4) and </p> \(a_1 \equiv\)
                    <p class="mono">3 (mod 4) then set s </p>\(\leftarrow \)
                    <p class="mono">-s</p>
                </li>
                <li class="container">
                    <p class="mono">Set</p> \(n_1 \leftarrow\)
                    <p class="mono">n mod </p>\(a_1 \)
                </li>
                <li class="container">
                    <p class="mono">If</p> \(a_1\)
                    <p class="mono">1 then return s </p><br>
                    <p class="mono tab">Otherwise return s*JACOBI</p>\((n_1,a_1)\)
                </li>
                </ol>
                <p>Algorytm działa w czasie \(\mathcal{O}( (lg n)^2)\) operacji bitowych.</p>
                <br>
				<?php
					readComments(2);
				?>
         </section>

        <section id="Alg3">
                <h2>Schemat progowy (t,n) dzielenia sekretu Shamira</h2>
                <p><b>Cel:</b> Zaufana Trzecia Strona <i>T</i> ma sekret <i>S</i> \( \geqslant\) 0, który chce podzielić pomiędzy <i>n</i> uczestników tak, aby dowolnych <i>t</i> spośród nich mogło sekret odtworzyć.</p>
                <p><b>Faza inicjalizacji:</b></p>
                <ul>
                    <li>
                        <p><i>T</i> wybiera losową pierwszą <i>p</i> \(>\) max(<i>S</i>,<i>n</i>) i definiuje \(a_0\) = <i>S</i>,</p>
                    </li>
                    <li>
                        <i>T</i> wybiera losowo i niezależnie <i>t</i> - 1 współczynników \(a_1, ..., a_{t-1} \in \mathbb{Z}_p\),
                    </li>
                    <li>
                        <p><i>T</i> definiuje wielomian nad \(\mathbb{Z}_p\): </p>
                        $$ f(x) = a_0 + \sum_{j=1}^{t-1} a_jx^j,$$
                    </li>
                    <li>
                        Dla \(1 \leqslant i \leqslant n\,\) Zaufana Trzecia Strona <i>T</i> wybiera losowo \(x_i \in \,\mathbb{Z}_p,\) oblicza: \(S_i\) = f(\(x_i\)) mod
                        <i>p</i> i bezpiecznie przekazuje parę \((x_i,S_i)\) użytkownikowi \(P_i\).
                    </li>
                </ul>
                <p><b>Faza łączenia udziałów w sekret:  </b> Dowolna grupa <i>t</i> lub więcej użtkowników łączy swoje udziały - <i>t</i> różnych punktów \((x_i,S_i)\) wielomianu f i dzięki interpolacji Lagrange'a odzyskuje sekret \(S = a_0 = f(0)\). </p>
                <h2>
                    Interpolacja Lagrange'a
                </h2>
                <p>Mając dane <i>t</i> różnych punktów \((x_i,y_i)\) nieznanego wielomianu f stopnia mniejszego od <i>t</i> możemy policzyć jego współczynniki korzystając ze wzoru:</p>
                $$ f(x) = \sum_{i = 1}^{t} \bigg(y_i \prod_{1 \leqslant j \leqslant t, j \neq i} \frac {x - x_j}{x_i - x_j}\bigg) mod\,p $$
                <p><b>Wskazówka:</b> w schemacie Shamira, aby odzyskąc sekret S, użytkownicy nie muszą znać całego wielomianu f. Wstawiając do wzoru na interpolację Lagrange'
                    <i>x</i> = 0, dostajemy wersję uproszczoną, ale wystarczającą, aby policzyć sekret S = \(f(0)\):</p>
                $$ f(x) = \sum_{i = 1}^{t} \bigg(y_i \prod_{1 \leqslant j \leqslant t, j \neq i} \frac {x_j}{x_i - x_j}\bigg) mod\,p $$
        	    <?php 
					readComments(3);
				?>
		</section>

		 <section id="Alg4">
				<h2>Przykład</h2>
                <p>Weźmy <i>S</i> = 6, <i>n</i> = 3 oraz <i>t</i> = 2</p>
                <ol>
                    <li>T wybiera \(p = 7 > max(S,n) = 6\)</li>
                    <li>\(t - 1 = 1 \textrm{ i niech } a_1 = 4\)</li>
                    <li>\(f(x) = a_0 + a_1x = S + a_1x = 6+4x\)</li>
                    <li>
                        T losowo wybiera:<br> \(x_1 = 2 \Rightarrow S_1 = f(x_1)\,mod\,7 = 0 \)
                        <br> \(x_2 = 1 \Rightarrow S_2 = f(x_2)\,mod\,7 = 3 \)
                        <br> \(x_3 = 3 \Rightarrow S_3 = f(x_3)\,mod\,7 = 4 \)
                        <br> i przekazuje pary 3 uczestnikom.
                    </li>
                </ol>
                <p>Pierwszy i drugi uczestnik chcą odczytać sekret: </p>
                <p>\(S = f(0) = (0 \cdot \frac 1 {1-2})\, mod\, 7 + (3 \cdot \frac 2 {2 - 1})\, mod \, 7 = 3 \cdot 2 = 6 \)</p>
				<?php
					readComments(4);
				?>
        </section>
    </main>

<div id="myModalUP" class="modal">

 
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Rejestracja</h2>
    </div>
    <div class="modal-body">
		<form method="post" action="">
			<div class="input-group">
				<label>Nazwa użytkownika</label><br>
				<input type="text" name="username">
			</div>
			<div class="input-group">
				<label>Email</label><br>
				<input type="email" name="email">
			</div>
			<div class="input-group">
				<label>Hasło</label><br>
				<input type="password" name="password_1">
			</div>
			<div class="input-group">
				<label>Potwierdź hasło</label><br>
				<input type="password" name="password_2">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="reg_user">Wyślij</button>
			</div>


		</form>
    </div>
  </div>
</div>

<div id="myModalIN" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Logowanie</h2>
    </div>
    <div class="modal-body">
		<form method="post" action="index.php">
			<div class="input-group">
				<label>Nazwa użytkownika</label><br>
				<input type="text" name="username">
			</div>
			<div class="input-group">
				<label>Hasło</label><br>
				<input type="password" name="password_1">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="log_user">Zaloguj</button>
			</div>
		</form>
    </div>
  </div>
</div>

<div id="myModalCookies" class="modal">
 
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Ciasteczka</h2>
    </div>
    <div class="modal-body">
		<p>Informujemy, iż w celu ułątwienia korzystania z tej strony i umożliwienia tym samym przeglądanie strony jako zalogowany użtkownik korzystamy z informacji zapisanych za pomocą plików cookies na urządzeniach końcowych użytkowników. Pliki cookies użytkownik może kontrolować za pomocą ustawień swojej przeglądarki internetowej. Dalsze korzystanie z naszego serwisu internetowego, bez zmiany ustawień przeglądarki internetowej oznacza, iż użytkownik akceptuje stosowanie plików cookies.</p>
				<button id="myModalButton" class="btn" >OK</button>
    </div>
  </div>
</div>

<script src="myscript.js"></script>
</body>

</html>