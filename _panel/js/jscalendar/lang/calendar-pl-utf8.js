﻿// ** I18N

// Calendar PL language
// Author: Dariusz Pietrzak, <eyck@ghost.anime.pl>
// Author: Janusz Piwowarski, <jpiw@go2.pl>
// Encoding: utf-8
// Distributed under the same terms as the calendar itself.

Calendar._DN = new Array
("Niedziela",
 "Poniedziałek",
 "Wtorek",
 "Środa",
 "Czwartek",
 "Piątek",
 "Sobota",
 "Niedziela");
Calendar._SDN = new Array
("Nie",
 "Pn",
 "Wt",
 "Śr",
 "Cz",
 "Pt",
 "So",
 "Nie");
Calendar._MN = new Array
("Styczeń",
 "Luty",
 "Marzec",
 "Kwiecień",
 "Maj",
 "Czerwiec",
 "Lipiec",
 "Sierpień",
 "Wrzesień",
 "Październik",
 "Listopad",
 "Grudzień");
Calendar._SMN = new Array
("Sty",
 "Lut",
 "Mar",
 "Kwi",
 "Maj",
 "Cze",
 "Lip",
 "Sie",
 "Wrz",
 "Paź",
 "Lis",
 "Gru");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "O kalendarzu";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2003\n" + // don't translate this this ;-)
"Aby pobrać najnowszą wersję, odwiedź: http://dynarch.com/mishoo/calendar.epl\n" +
"Dostępny na licencji GNU LGPL. Zobacz szczegóły na http://gnu.org/licenses/lgpl.html." +
"\n\n" +
"Wybór daty:\n" +
"- Użyj przycisków \xab, \xbb by wybrać rok\n" +
"- Użyj przycisków " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " by wybrać miesiąc\n" +
"- Przytrzymaj klawisz myszy nad jednym z powyższych przycisków dla szybszego wyboru.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Wybór czasu:\n" +
"- Kliknij na jednym z pól czasu by zwiększyć jego wartość\n" +
"- lub kliknij trzymając Shift by zmiejszyć jego wartość\n" +
"- lub kliknij i przeciągnij dla szybszego wyboru.";

Calendar._TT["PREV_YEAR"] = "Poprzedni rok (przytrzymaj dla menu)";
Calendar._TT["PREV_MONTH"] = "Poprzedni miesiąc (przytrzymaj dla menu)";
Calendar._TT["GO_TODAY"] = "Idź do dzisiaj";
Calendar._TT["NEXT_MONTH"] = "Następny miesiąc (przytrzymaj dla menu)";
Calendar._TT["NEXT_YEAR"] = "Następny rok (przytrzymaj dla menu)";
Calendar._TT["SEL_DATE"] = "Wybierz datę";
Calendar._TT["DRAG_TO_MOVE"] = "Przeciągnij by przesunąć";
Calendar._TT["PART_TODAY"] = " (dzisiaj)";

// date formats
Calendar._TT["DAY_FIRST"] = "Display %s first";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Zamknij";
Calendar._TT["TODAY"] = "Dziś";
Calendar._TT["TIME_PART"] = "(Shift-)Click or drag to change value";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "tyg";
Calendar._TT["TIME"] = "Czas:";