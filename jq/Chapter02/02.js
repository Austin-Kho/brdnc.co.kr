// This is the custom JavaScript file referenced by index.html. You will notice
// that this file is currently empty. By adding code to this empty file and
// then viewing index.html in a browser, you can experiment with the example
// page or follow along with the examples in the book.
//
// See README.txt for more information.

$(() => {
    $('#selected-plays > li').addClass('horizontal');
    $('#selected-plays li:not(.horizontal)').addClass('sub-level');
    $('#selected-plays > li').addClass('big-letter');
    $('a[href^="mailto:"]').addClass('mailto');
    $('a[href$=".pdf"]').addClass('pdflink');
    $('a[href^="http"][href*="henry"]').addClass('henrylink');
    $('tr:nth-child(odd)').addClass('alt');
    // $('tr').filter(':even').addClass('alt');
    $('td:contains(Henry)').addClass('highlight');
    $('a').filter((i, a) =>a.hostname && a.hostname !== location.hostname).addClass('external');
    // $('td:contains(Henry)').nextAll().addBack().addClass('highlight');
    // $('td:contains(Henry)').parent().children().addClass('highlight');
    $('td:contains(Henry)') // "Henry" 를 포함한 요소를 셀 선택
     .parent() // 부모 선택
     .find('td:eq(1)') // 두 번째 자손 셀을 찾음
     .addClass('highlight') // "highlight" 클래스를 추가함
     .end() // "Henry" 를 포함한 셀의 부모 요소에 반환
     .find('td:eq(2)')  // 세 번째 자손 셀을 찾음
     .addClass('highlight') // "highlight" 클래스를 추가함
    const eachText = [];
    $('td')
    .each((i, td) => {
      if(td.textContent.startsWith('H')) {
        eachText.push(td.textContent);
      }
    });
    console.log('each', eachText);
    const forText = [];
    for (let td of $('td')) {
      if(td.textContent.startsWith('H')) {
        forText.push(td.textContent);
      }
    }
    console.log('for', forText);
    // ["Hamlet", "Henry IV, Part I", "History", "Henry V", "History"]
    console.log('get', $('.big-letter')[0].tagName);    
  });