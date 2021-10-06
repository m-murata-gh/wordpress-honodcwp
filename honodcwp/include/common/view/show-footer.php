<?php

function showFooter(): void {

echo <<<HTML

<!-- [footer] -->
<footer class="footer structure">
  <div class="inner footer__inner">
    <div class="logo--sm footer__logo--sm"><a href="{$GLOBALS['urlIndex']}"><h1><img src="{$GLOBALS['urlIndex']}assets/images/logo_white.svg" alt="ほの歯科クリニック HONO DENTAL CLINIC"></h1></a></div>
    <!-- /.logo--sm -->
    <div class="footer__info">
      <p>TEL.0794-XX-XXXX
      <p>兵庫県加古川市米田町XXX-XXX
    </div>
    <!-- /.footer__info -->
    <div class="time-table footer__time-table">
      <div class="time-table__inner">
        <table border="1">
          <thead>
            <tr>
              <th>診療時間
              <td>月
              <td>火
              <td>水
              <td>木
              <td>金
              <td>土
              <td>日
              <td>祝
          <tbody>
            <tr>
              <th>9:30～12:00
              <td>●
              <td>●
              <td>－
              <td>●
              <td>●
              <td>●
              <td>－
              <td>－
            <tr>
              <th>14:00～20:00
              <td>●
              <td>▲
              <td>－
              <td>●
              <td>▲
              <td>▲
              <td>－
              <td>－
        </table>
        <p>▲…14:00～18:00
        <p>【休診日】水曜・日曜・祝日
      </div>
      <!-- /.time-table__inner -->
    </div>
    <!-- /.time-table -->
    <div class="footer__copyright">
      <p><small>&copy; 2021 ほの歯科クリニック</small>
    </div>
    <!-- /.footer__copyright -->
  </div>
  <!-- /.inner -->


  <div id="scroll-top" class="scroll-top">
  </div><!-- /.scroll-top -->

</footer>

</body>
</html>

HTML;
}
