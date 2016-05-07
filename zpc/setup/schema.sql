<?
// 이 파일은 [CMS]에서 사용하는 테이블의 스키마정보를 가지고 있습니다.
// 이 파일을 수정시에는 조심하여 주시기바랍니다.

$accouts_tb="cms_accounts"; // 거래처 정보 테이블
$board_no_tb="cms_board_notice"; // 공지사항 게시판
$cap_acc_d1_tb="cms_capital_account_d1"; // 회계 계정과목 1
$cap_acc_d2_tb="cms_capital_account_d2"; // 회계 계정과목 2
$cap_acc_d3_tb="cms_capital_account_d3"; // 회계 계정과목 3
$cap_bank_acc_tb="cms_capital_bank_account"; // 은행계좌 
$cap_bank_code_tb="cms_capital_bank_code"; // 은행코드
$cap_cash_book_tb="cms_capital_cash_book"; // 거래기록부//금전출납부
$com_div_tb="cms_com_div"; // 회사 부서 테이블
$com_div_mem_tb="cms_com_div_mem"; // 회사 부서별 멤버
$com_info_tb="cms_com_info"; // 회사 정보
$customers_tb="cms_customers_db"; // 고객정보 DB
$member_tb="cms_member_table"; // 회원들의 데이터가 들어있는 직접적인 테이블	
$mem_auth_tb="cms_mem_auth"; // 회원 권한 설정 디비
$message_tb="cms_message_info"; // 메세지 디비
$project_db_tb="cms_project_data"; // 현장 데이터 디비
$project_if_tb="cms_project_info"; // 현장 정보 디비
$resource_h_tb="cms_resource_headq"; // 현장 인원 본부 정보
$resource_t_tb="cms_resource_team"; // 현장 인원 팀 정보
$resource_m_tb="cms_resource_team_member"; // 현장 인원 팀원 정보
$stock_d1_tb="cms_stock_1st_classify"; // 재고 1차 분류
$stock_d2_tb="cms_stock_2nd_classify"; // 재고 2차 분류
$stock_d3_tb="cms_stock_3rd_classify"; // 재고 3차 분류
$stock_d4_tb="cms_stock_4th_classify"; // 재고 4차 분류
$stock_main_tb="cms_stock_main"; // 재고 메인
$tax_office_tb="cms_tax_office"; // 세무서 정보
$work_coun_log_tb="cms_work_coun_log"; // 상담일지 기록
$work_log_tb="cms_work_log"; // 업무일지 기록
$work_rep_tb="cms_work_rep"; // 업무보고 기록
$zipcode_tb="cms_zipcode"; // 우편번호 디비

////////////////////////////////////////////////////////////////////////////
// 1. 거래처 정보 테이블
///////////////////////////////////////////////////////////////////////////

$accouts_tb_schema = "

CREATE TABLE IF NOT EXISTS `$accouts_tb` (
  `seq` int(5) NOT NULL AUTO_INCREMENT,
  `si_name` varchar(100) NOT NULL DEFAULT '',
  `acc_cla` tinyint(1) NOT NULL,
  `main_tel` varchar(30) NOT NULL,
  `main_fax` varchar(30) NOT NULL,
  `main_web` varchar(50) NOT NULL,
  `web_name` varchar(50) NOT NULL,
  `res_div` varchar(20) NOT NULL COMMENT '담당부서 '';''로 구분 추가',
  `res_worker` varchar(20) NOT NULL COMMENT '담당자 '';''로 구분 추가',
  `res_mobile` varchar(13) NOT NULL COMMENT '담당핸드폰 '';''로 구분 추가',
  `res_email` varchar(30) NOT NULL COMMENT '담당이메일 '';''로 구분 추가',
  `tax_no` varchar(20) NOT NULL,
  `tax_ceo` varchar(20) NOT NULL,
  `tax_addr` varchar(200) NOT NULL,
  `tax_uptae` varchar(50) NOT NULL,
  `tax_jongmok` varchar(50) NOT NULL,
  `tax_worker` varchar(20) NOT NULL,
  `tax_email` varchar(30) NOT NULL,
  `note` text,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`seq`),
  KEY `si_name` (`si_name`),
  KEY `acc_name` (`web_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='거래처 정보 테이블' ;

";

////////////////////////////////////////////////////////////////////////////
// 2. 공지사항 게시판
///////////////////////////////////////////////////////////////////////////

$board_no_tb_schema = "

CREATE TABLE IF NOT EXISTS `$board_no_tb` (
  `no` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `ismember` int(20) NOT NULL DEFAULT '0',
  `islevel` int(20) NOT NULL DEFAULT '10',
  `name` varchar(20) NOT NULL DEFAULT '',
  `passwd` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `division` varchar(20) NOT NULL DEFAULT '',
  `category` int(11) NOT NULL DEFAULT '1',
  `subject` varchar(250) NOT NULL DEFAULT '',
  `memo` text,
  `is_secret` char(1) NOT NULL DEFAULT '0',
  `file_name1` varchar(250) DEFAULT NULL,
  `file_name2` varchar(250) DEFAULT NULL,
  `s_file_name1` varchar(250) DEFAULT NULL,
  `s_file_name2` varchar(250) DEFAULT NULL,
  `reg_date` int(13) NOT NULL DEFAULT '0',
  `hit` int(11) NOT NULL DEFAULT '0',
  `vote` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`),
  KEY `subject` (`subject`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='nc2u 공지 게시판' ;

";


////////////////////////////////////////////////////////////////////////////
// 3. 회계 계정과목 1
///////////////////////////////////////////////////////////////////////////

$cap_acc_d1_tb_schema = "

CREATE TABLE IF NOT EXISTS `$cap_acc_d1_tb` (
  `seq` int(1) NOT NULL AUTO_INCREMENT,
  `d1_acc_name` varchar(30) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `d1_acc_name` (`d1_acc_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

$cap_acc_d1_tb_insert_schema = "

INSERT INTO `$cap_acc_d1_tb` (`d1_acc_name`, `note`) VALUES
('수익', '수익 계정과목 기준'),
('비용', '비용 계정과목 기준');

";


////////////////////////////////////////////////////////////////////////////
// 4. 회계 계정과목 2
///////////////////////////////////////////////////////////////////////////

$cap_acc_d2_tb_schema = "

CREATE TABLE IF NOT EXISTS `$cap_acc_d2_tb` (
  `seq` int(2) NOT NULL AUTO_INCREMENT,
  `d1_seq` int(1) NOT NULL,
  `d2_acc_name` varchar(30) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `d2_acc_name` (`d2_acc_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

$cap_acc_d2_tb_insert_schema = "

INSERT INTO `$cap_acc_d2_tb` (`d1_seq`, `d2_acc_name`, `note`) VALUES
(1, '매출', '매출 계정과목 기준'),
(2, '매출원가', '매출원가 계정과목 기준'),
(2, '판매비 및 일반관리비', '판매비 및 일반관리비 계정과목 기준'),
(1, '영업외수익', '영업외수익 계정과목 기준'),
(2, '영업외비용', '영업외비용 계정과목 기준'),
(2, '법인세비용', '법인세비용 계정과목 기준');

";


////////////////////////////////////////////////////////////////////////////
// 5. 회계 계정과목 3
///////////////////////////////////////////////////////////////////////////

$cap_acc_d3_tb_schema = "

CREATE TABLE IF NOT EXISTS `$cap_acc_d3_tb` (
  `seq` int(3) NOT NULL AUTO_INCREMENT,
  `d1_seq` int(1) NOT NULL,
  `d2_seq` int(2) NOT NULL,
  `d3_acc_name` varchar(30) NOT NULL,
  `is_sp_acc` tinyint(1) NOT NULL COMMENT '특별(희귀) 계정여부',
  `note` text NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `d3_acc_name` (`d3_acc_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

$cap_acc_d3_tb_insert_schema = "

INSERT INTO `$cap_acc_d3_tb` (`d1_seq`, `d2_seq`, `d3_acc_name`, `is_sp_acc`, `note`) VALUES
(1, 1, '상품매출', 0, '도소매업 매출'),
(1, 1, '제품매출', 0, '제조업 매출'),
(1, 1, '매출', 0, '기타 매출'),
(1, 1, '공사수입금', 0, '건설업 매출'),
(2, 2, '상품매출원가', 0, '기초상품 + 당기상품 매입액 - 기말상품 재고액'),
(2, 2, '관세환급금(상품)', 1, '상품에 대한 관세환급금'),
(2, 2, '매입할인', 1, '외상매입금을 약정기일 전에 지급함으로써 일정액을 할인 받는 것'),
(2, 2, '제조', 1, '제조'),
(2, 2, '제품매출원가', 0, '기초제품 + 당기제품매입액 - 기말제품 재고액'),
(2, 2, '관세환급금(제조)', 1, '제조업의 관세환급금'),
(2, 3, '임원급여', 1, '임원 등의 급여(소기업은 구분할 필요없이 급료에 포함)'),
(2, 3, '급여', 0, '사무실 직원 급료'),
(2, 3, '상여금', 0, '사무실 직원 상여금'),
(2, 3, '제수당', 1, '기본급외 제수당(소기업은 구분할 필요없이 급료에 포함)'),
(2, 3, '잡급', 0, '임시직원 및 일용근로자 급료 및 임금'),
(2, 3, '퇴직급여', 1, '퇴직급여'),
(2, 3, '복리후생비', 0, '식대, 차대, 4대보험 중 회사부담금, 직원경조사비, 회식비, 생수대금, 야유회경비, 피복비, 구내식당 운영비 등'),
(2, 3, '여비교통비', 0, '직무와 관련한 각종 출장비 및 여비'),
(2, 3, '접대비', 0, '거래선접대비, 거래선 선물대, 거래선 경조사비 등'),
(2, 3, '통신비', 0, '전화요금, 휴대폰요금, 정보통신요금, 각종 우편요금 등'),
(2, 3, '수도광열비', 0, '수도요금, 가스요금, 난방비용 등'),
(2, 3, '세금과공과금', 0, '재산세, 종합토지세, 인지대, 면허세, 주민세(8.31납기), 사업소세, 환경개선부담금, 수입증지 등'),
(2, 3, '감가상각비', 0, '유형자산(건물, 비품, 차량 등)의 감가상각비'),
(2, 3, '임차료', 0, '사무실 등 임차료'),
(2, 3, '수선비', 0, '사무실 수리비, 비품수리비 등'),
(2, 3, '보험료', 0, '건물화재보험료, 승용자동차 보험료 등'),
(2, 3, '차량유지비', 0, '유류대, 주차요금, 통행료, 자동차수리비, 검사비 등'),
(2, 3, '연구개발비', 0, '신기술의 개발 및 도입과 관련하여 지출하는 경상적인 비용'),
(2, 3, '운반비', 0, '택배요금, 퀵서비스요금 등'),
(2, 3, '교육훈련비', 0, '직원교육 및 업무훈련과 관련하여 지급한 금액'),
(2, 3, '도서인쇄비', 0, '신문대, 도서구입비, 서식인쇄비, 복사요금, 사진현상비, 명함, 고무인제작비, 명판대 등'),
(2, 3, '회의비', 0, '업무회의와 관련하여 지출하는 각종 비용'),
(2, 3, '포장비', 0, '상품 등의 포장과 관련한 지출비용'),
(2, 3, '소모품비', 0, '각종 위생용 소모품, 철물 및 전기용품, 기타 소모품'),
(2, 3, '지급수수료', 0, '기장수수료, 송금, 각종 증명발급, 추심, 신용보증, 보증보험 수수료, 홈페이지 유지비, 전기가스점검 및 환경측정수수료, 신용조회수수료'),
(2, 3, '보관료', 0, '물품 등의 보관과 관련하여 지출하는 비용'),
(2, 3, '광고선전비', 0, 'TV, 신문, 잡지광고비, 홈페이지 제작·등록비 등 광고비용'),
(2, 3, '판매촉진비', 0, '판매촉진과 관련하여 지출하는 비용'),
(2, 3, '대손상각비', 0, '외상매출금, 미수금 등의 회수불능대금'),
(2, 3, '기밀비', 0, '판공비, 사례비 등'),
(2, 3, '수출제비용', 0, '수출과 관련한 제비용'),
(2, 3, '판매수수료', 0, '판매와 관련하여 지급한 수수료'),
(2, 3, '무형자산상각비', 0, '이연자산 상각(유형자산 ~ 감가상각 무형자산 ~ 무형자산 상각)'),
(2, 3, '환가료', 1, '외국환은행이 대고객 외국환거래에 따르는 자금부담을 보상받기 위하여 징수하는 여신금리적 성격의 수수료'),
(2, 3, '견본비', 0, '견본물품 등의 구입과 관련한 비용'),
(2, 3, '잡비', 0, '오폐수처리비, 세탁비, 소액 교통사고배상금, 방화관리비, 청소용역비 등 기타 달리 분류되지 않는 각종 비용'),
(2, 3, '외주비', 0, '다른 기업 등에 업무의 일부를 발주하는 경우의 비용'),
(2, 3, '피복비', 0, '직원들의 유니폼, 작업복 등을 구입한 비용'),
(2, 3, '창업비', 1, '법인설립당시에 소요된 창업관련 제비용'),
(2, 3, '개업비', 1, '법인 설립 후 사업개시일까지 소요된 제비용'),
(1, 4, '이자수익', 0, '예금 및 적금이자, 대여금 이자수입 등'),
(1, 4, '유가증권이자', 0, '국채, 지방채, 공채, 사채(社債) 등의 이자'),
(1, 4, '배당금수익', 0, '주식투자와 관련하여 소유주식 회사로부터 지급받는 배당금'),
(1, 4, '임대료', 0, '부동산 임대수입'),
(1, 4, '유가증권처분이익', 0, '유가증권 처분 시 발생하는 이익'),
(1, 4, '외환차익', 0, '외화자산, 부채의 회수 및 상환시 환율변동으로 발생하는 이익'),
(1, 4, '대손충당금환입액', 1, '대손충당금 환입액'),
(1, 4, '수입수수료', 0, '수입수수료'),
(1, 4, '외화환산이익', 0, '외화환산이익'),
(1, 4, '유형자산처분이익', 0, '유형자산 처분시 발생하는 이익'),
(1, 4, '투자자산처분이익', 0, '투자자산 처분시 발생하는 이익'),
(1, 4, '상각채권추심이익', 1, '상각처리된 채권에 대한 추심으로 인해 발생한 이익'),
(1, 4, '잡이익', 0, '기타 달리 분류되지 않는 이익'),
(1, 4, '자산수증이익', 1, '현금이나 기타의 재산을 무상으로 제공받음으로써 생기는 이익'),
(1, 4, '채무면제이익', 1, '채무를 면제받아 생긴 이익'),
(1, 4, '보험차익', 1, '가입한 보혐의 만기보험금 또는 해약환급금이 납입한 보험료보다 많은 경우의 차액'),
(1, 4, '투자준비금환입액', 1, '투자준비금 환입액'),
(1, 4, '기술개발준비금환입액', 1, '기술개발준비금 환입액'),
(2, 5, '이자비용', 0, '지급이자, 어음할인료 등'),
(2, 5, '외환차손', 0, '환율변동으로 인하여 발생하는 손실금액'),
(2, 5, '기부금', 0, '교회 및 사찰헌금, 학교기부금, 불우이웃돕기 성금 등'),
(2, 5, '기타대손상각비', 1, '기타대손 상각비'),
(2, 5, '외화환산손실', 1, '외화환산 손실'),
(2, 5, '유가증권처분손실', 0, '유가증권의 처분시 발생하는 손실'),
(2, 5, '재고자산감모손실', 0, '재고자산의 손상 및 분실금액'),
(2, 5, '재고자산평가손실', 0, '재고자산의 평가 결과 발생한 손실금액'),
(2, 5, '회사채이자', 1, '회사채 이자'),
(2, 5, '유형자산처분손실', 0, '유형자산(기계장치,차량운반구 등)의 처분시 발생하는 손실'),
(2, 5, '투자자산처분손실', 0, '투자자산의 처분시 발생하는 손실'),
(2, 5, '잡손실', 0, '분실금, 기타 달리 분류되지 않는 영업외비용'),
(2, 5, '재해손실', 1, '재해 손실'),
(2, 6, '법인세등', 0, '법인세, 법인세 주민세, 법인세 중간예납세액'),
(2, 6, '소득세등', 0, '종합소즉세, 종합소득세 주민세');

";


////////////////////////////////////////////////////////////////////////////
// 6. 은행계좌 
///////////////////////////////////////////////////////////////////////////

$cap_bank_acc_tb_schema = "

CREATE TABLE IF NOT EXISTS `$cap_bank_acc_tb` (
  `no` int(2) NOT NULL AUTO_INCREMENT,
  `bank` varchar(15) NOT NULL DEFAULT '',
  `bank_code` varchar(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(30) NOT NULL DEFAULT '',
  `holder` varchar(20) NOT NULL,
  `is_com` int(1) NOT NULL,
  `div_seq` int(3) NOT NULL,
  `pj_seq` int(5) NOT NULL,
  `manager` varchar(20) NOT NULL,
  `open_date` date NOT NULL DEFAULT '0000-00-00',
  `note` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`no`),
  KEY `bank` (`bank`),
  KEY `name_2` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='회사 현금 및 은행 계좌' ;

";

$cap_bank_acc_tb_insert_schema = "

INSERT INTO `$cap_bank_acc_tb` (`bank`, `bank_code`, `name`, `number`, `holder`, `is_com`, `div_seq`, `pj_seq`, `manager`, `open_date`, `note`) VALUES
('현금계정', '', '현금', '', '', 1, 0, 0, '', '0000-00-00', '');

";

////////////////////////////////////////////////////////////////////////////
// 7. 은행코드
///////////////////////////////////////////////////////////////////////////

$cap_bank_code_tb_schema = "

CREATE TABLE IF NOT EXISTS `$cap_bank_code_tb` (
  `bank_code` varchar(3) NOT NULL COMMENT '코드',
  `bank_name` varchar(30) NOT NULL COMMENT '은행명',
  PRIMARY KEY (`bank_code`),
  KEY `band_name` (`bank_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='은행 코드 테이블';

";

$cap_bank_code_tb_insert_schema = "

INSERT INTO `$cap_bank_code_tb` (`bank_code`, `bank_name`) VALUES
('001', '한국은행\r\n'),
('002', '산업은행\r\n'),
('003', '기업은행\r\n'),
('004', '국민은행\r\n'),
('005', '외환은행\r\n'),
('007', '수협중앙회\r\n'),
('008', '수출입은행\r\n'),
('011', '농협중앙회\r\n'),
('012', '농협회원조합\r\n'),
('020', '우리은행\r\n'),
('023', 'SC제일은행\r\n'),
('027', '한국씨티은행\r\n'),
('031', '대구은행\r\n'),
('032', '부산은행\r\n'),
('034', '광주은행\r\n'),
('035', '제주은행\r\n'),
('037', '전북은행\r\n'),
('039', '경남은행\r\n'),
('045', '새마을금고연합회\r\n'),
('048', '신협중앙회\r\n'),
('050', '상호저축은행\r\n'),
('052', '모건스탠리은행\r\n'),
('054', 'HSBC은행\r\n'),
('055', '도이치은행\r\n'),
('056', '알비에스은행\r\n'),
('057', '제이피모간체이스은행\r\n'),
('058', '미즈호코퍼레이트은행\r\n'),
('059', '미쓰비시도쿄UFJ은행\r\n'),
('060', 'BOA은행\r\n'),
('064', '산림조합\r\n'),
('071', '지식경제부 우체국\r\n'),
('076', '신용보증기금\r\n'),
('077', '기술신용보증기금\r\n'),
('081', '하나은행\r\n'),
('088', '신한은행\r\n'),
('092', '한국정책금융공사\r\n'),
('093', '한국주택금융공사\r\n'),
('094', '서울보증보험\r\n'),
('095', '경찰청\r\n'),
('096', '한국전자금융(주)\r\n'),
('099', '금융결제원\r\n'),
('209', '동양종합금융증권\r\n'),
('218', '현대증권\r\n'),
('230', '미래에셋증권\r\n'),
('238', '대우증권\r\n'),
('240', '삼성증권\r\n'),
('243', '한국투자증권\r\n'),
('247', '우리투자증권\r\n'),
('261', '교보증권\r\n'),
('262', '하이투자증권\r\n'),
('263', 'HMC투자증권\r\n'),
('264', '키움증권\r\n'),
('265', '이트레이드증권\r\n'),
('266', 'SK증권\r\n'),
('267', '대신증권\r\n'),
('268', '솔로몬투자증권\r\n'),
('269', '한화증권\r\n'),
('270', '하나대투증권\r\n'),
('278', '신한금융투자\r\n'),
('279', '동부증권\r\n'),
('280', '유진투자증권\r\n'),
('287', '메리츠종합금융증권\r\n'),
('289', 'NH투자증권\r\n'),
('290', '부국증권\r\n'),
('291', '신영증권\r\n'),
('292', 'LIG투자증권\r\n');

";


////////////////////////////////////////////////////////////////////////////
// 8. 거래기록부//금전출납부
///////////////////////////////////////////////////////////////////////////

$cap_cash_book_tb_schema = "

CREATE TABLE IF NOT EXISTS `$cap_cash_book_tb` (
  `seq_num` int(20) NOT NULL AUTO_INCREMENT,
  `com_div` int(3) DEFAULT NULL,
  `pj_seq` int(5) DEFAULT NULL,
  `class1` int(1) NOT NULL DEFAULT '0',
  `class2` int(1) NOT NULL DEFAULT '0',
  `is_jh_loan` int(1) NOT NULL DEFAULT '0' COMMENT '조합 대여금 여부',
  `account` varchar(20) NOT NULL COMMENT '계정과목',
  `cont` varchar(100) NOT NULL DEFAULT '',
  `acc` varchar(30) NOT NULL DEFAULT '',
  `in_acc` int(3) NOT NULL DEFAULT '0',
  `inc` int(20) NOT NULL DEFAULT '0',
  `out_acc` int(3) NOT NULL DEFAULT '0',
  `exp` int(20) NOT NULL DEFAULT '0',
  `evidence` int(1) NOT NULL DEFAULT '0',
  `worker` varchar(20) NOT NULL DEFAULT '',
  `deal_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`seq_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='현금 출납부' ;

";


////////////////////////////////////////////////////////////////////////////
// 9. 회사 부서 테이블
///////////////////////////////////////////////////////////////////////////

$com_div_tb_schema = "

CREATE TABLE IF NOT EXISTS `$com_div_tb` (
  `seq` int(3) NOT NULL AUTO_INCREMENT,
  `com_seq` int(3) NOT NULL,
  `div_code` varchar(10) NOT NULL,
  `div_name` varchar(20) NOT NULL,
  `manager` varchar(20) NOT NULL DEFAULT '',
  `div_tel` varchar(13) NOT NULL,
  `res_work` varchar(30) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='회사 부서 정보 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 10. 회사 부서별 멤버
///////////////////////////////////////////////////////////////////////////

$com_div_mem_tb_schema = "

CREATE TABLE IF NOT EXISTS `$com_div_mem_tb` (
  `seq` int(3) NOT NULL AUTO_INCREMENT,
  `com_seq` int(2) NOT NULL,
  `div_seq` int(3) NOT NULL,
  `div_posi` varchar(20) NOT NULL,
  `mem_name` varchar(20) NOT NULL,
  `dir_tel` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_num` varchar(14) NOT NULL,
  `join_date` date NOT NULL,
  `is_reti` tinyint(1) NOT NULL,
  `reti_date` date NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `mem_name` (`mem_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='직원 데이터 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 11. 회사 정보
///////////////////////////////////////////////////////////////////////////

$com_info_tb_schema = "

CREATE TABLE IF NOT EXISTS `$com_info_tb` (
  `seq` int(3) NOT NULL AUTO_INCREMENT,
  `co_name` varchar(50) NOT NULL DEFAULT '',
  `co_no` varchar(15) NOT NULL DEFAULT '',
  `co_form` int(1) NOT NULL DEFAULT '0',
  `ceo` varchar(20) NOT NULL DEFAULT '',
  `or_no` varchar(15) NOT NULL DEFAULT '',
  `sur` int(1) NOT NULL DEFAULT '0',
  `biz_cond` varchar(100) NOT NULL DEFAULT '',
  `biz_even` varchar(100) NOT NULL DEFAULT '',
  `co_phone` varchar(20) NOT NULL DEFAULT '',
  `co_hp` varchar(20) NOT NULL DEFAULT '',
  `co_fax` varchar(20) NOT NULL DEFAULT '',
  `co_div1` int(1) NOT NULL DEFAULT '0',
  `co_div2` int(1) NOT NULL DEFAULT '0',
  `co_div3` int(1) NOT NULL DEFAULT '0',
  `es_date` date NOT NULL DEFAULT '0000-00-00',
  `op_date` date NOT NULL DEFAULT '0000-00-00',
  `carr` varchar(7) NOT NULL DEFAULT '',
  `m_wo_st` int(2) NOT NULL DEFAULT '0',
  `bl_cycle` int(2) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `calc_mail` varchar(50) NOT NULL DEFAULT '',
  `tax_off1_code` int(5) NOT NULL DEFAULT '0',
  `tax_off1_name` varchar(20) NOT NULL DEFAULT '',
  `tax_off2_code` int(5) DEFAULT NULL,
  `tax_off2_name` varchar(20) DEFAULT NULL,
  `zipcode` varchar(7) NOT NULL DEFAULT '',
  `address1` varchar(100) NOT NULL DEFAULT '',
  `address2` varchar(50) NOT NULL DEFAULT '',
  `en_co_name` varchar(100) NOT NULL DEFAULT '',
  `en_address` varchar(250) NOT NULL DEFAULT '',
  `red_date` date NOT NULL DEFAULT '0000-00-00',
  `up_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`seq`),
  UNIQUE KEY `co_no` (`co_no`,`or_no`),
  KEY `co_name` (`co_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='회사 정보 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 12. 고객정보 DB
///////////////////////////////////////////////////////////////////////////

$customers_tb_schema = "

CREATE TABLE IF NOT EXISTS `$customers_tb` (
  `seq` int(8) NOT NULL AUTO_INCREMENT,
  `team_mem_seq` varchar(5) NOT NULL,
  `customers` varchar(20) NOT NULL,
  `cus_tel1` varchar(13) NOT NULL,
  `cus_tel2` varchar(13) NOT NULL,
  `counsel_route1` int(1) NOT NULL,
  `counsel_route2` int(1) NOT NULL,
  `residence_type` varchar(30) NOT NULL COMMENT '거주 지역 형태 메모',
  `prefer_type` varchar(20) NOT NULL COMMENT '선호 평형 타입 메모',
  `qualifi_cond` varchar(20) NOT NULL COMMENT '자격 조건 메모',
  `reg_date` date NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='고객 DB' ;

";


////////////////////////////////////////////////////////////////////////////
// 13. 회원들의 데이터가 들어있는 직접적인 테이블	
///////////////////////////////////////////////////////////////////////////

$member_tb_schema = "

CREATE TABLE IF NOT EXISTS `$member_tb` (
  `no` int(20) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` varchar(20) NOT NULL DEFAULT '',
  `passwd` varchar(32) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `id_number` varchar(18) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `rcv_mail` int(1) NOT NULL DEFAULT '1',
  `zipcode` varchar(7) NOT NULL DEFAULT '',
  `address1` varchar(100) NOT NULL DEFAULT '',
  `address2` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `request` int(1) NOT NULL DEFAULT '2' COMMENT '사용 승인 신청',
  `is_company` tinyint(1) DEFAULT '2',
  `div_seq` varchar(10) DEFAULT NULL,
  `pj_seq` int(10) DEFAULT NULL,
  `pj_where` varchar(10) NOT NULL,
  `pj_posi` int(1) NOT NULL DEFAULT '3',
  `auth_level` int(1) NOT NULL DEFAULT '10',
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`),
  KEY `user_id` (`user_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='cms 사용자 등록 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 14. 회원 권한 설정 디비
///////////////////////////////////////////////////////////////////////////

$mem_auth_tb_schema = "

CREATE TABLE IF NOT EXISTS `$mem_auth_tb` (
  `auth_seq` int(10) NOT NULL AUTO_INCREMENT,
  `user_no` int(10) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `sa_1_1` int(1) NOT NULL DEFAULT '0',
  `sa_1_2` int(1) NOT NULL DEFAULT '0',
  `sa_1_3` int(1) NOT NULL DEFAULT '0',
  `sa_2_1` int(1) NOT NULL DEFAULT '0',
  `sa_2_2` int(1) NOT NULL DEFAULT '0',
  `sa_2_3` int(1) NOT NULL DEFAULT '0',
  `pr_1_1` int(1) NOT NULL DEFAULT '0',
  `pr_1_2` int(1) NOT NULL DEFAULT '0',
  `pr_1_3` int(1) NOT NULL DEFAULT '0',
  `pr_2_1` int(1) NOT NULL DEFAULT '0',
  `pr_2_2` int(1) NOT NULL DEFAULT '0',
  `pr_2_3` int(1) NOT NULL DEFAULT '0',
  `ca_1_1` int(1) NOT NULL DEFAULT '0',
  `ca_1_2` int(1) NOT NULL DEFAULT '0',
  `ca_1_3` int(1) NOT NULL DEFAULT '0',
  `ca_2_1` int(1) NOT NULL DEFAULT '0',
  `ca_2_2` int(1) NOT NULL DEFAULT '0',
  `ct_1_1` int(1) NOT NULL DEFAULT '0',
  `ct_1_2` int(1) NOT NULL DEFAULT '0',
  `ct_2_1` int(1) NOT NULL DEFAULT '0',
  `ct_2_2` int(1) NOT NULL DEFAULT '0',
  `cg_1_1` int(1) NOT NULL DEFAULT '0',
  `cg_1_2` int(1) NOT NULL DEFAULT '0',
  `cg_1_3` int(1) NOT NULL DEFAULT '0',
  `cg_1_4` int(1) NOT NULL DEFAULT '0',
  `cg_2_1` int(1) NOT NULL DEFAULT '0',
  `cg_2_2` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auth_seq`),
  UNIQUE KEY `user_no` (`user_no`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='cms 멤버 권한 설정 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 15. 메세지 디비
///////////////////////////////////////////////////////////////////////////

$message_tb_schema = "

CREATE TABLE IF NOT EXISTS `$message_tb` (
  `mnum` int(20) NOT NULL AUTO_INCREMENT,
  `receive_id` varchar(20) NOT NULL DEFAULT '',
  `receiveid_fk` varchar(10) NOT NULL DEFAULT '',
  `receive_del` char(1) NOT NULL DEFAULT 'N',
  `receive_chk` char(1) NOT NULL DEFAULT 'N',
  `receive_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `send_id` varchar(20) NOT NULL DEFAULT '',
  `sendid_fk` varchar(10) NOT NULL DEFAULT '',
  `send_del` char(1) NOT NULL DEFAULT 'N',
  `send_chk` char(1) NOT NULL DEFAULT 'N',
  `message` text NOT NULL,
  `send_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mnum`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='멤버간 쪽지(메세지) 정보 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 16. 현장 데이터 디비
///////////////////////////////////////////////////////////////////////////

$project_db_tb_schema = "

CREATE TABLE IF NOT EXISTS `$project_db_tb` (
  `seq` int(10) NOT NULL AUTO_INCREMENT,
  `pj_seq` int(7) NOT NULL COMMENT '프로젝트 고유번호',
  `pj_sort` varchar(10) NOT NULL COMMENT '프로젝트 종류',
  `con_no` int(4) NOT NULL COMMENT '계약관리번호',
  `type_ho` varchar(5) NOT NULL COMMENT '타입',
  `sa_sort` tinyint(1) NOT NULL DEFAULT '0' COMMENT '조합/일반 구분',
  `diff_no` int(2) NOT NULL COMMENT '차수',
  `pj_dong` varchar(5) NOT NULL COMMENT '동',
  `pj_ho` int(4) NOT NULL COMMENT '호수',
  `is_pro_cont` tinyint(1) NOT NULL DEFAULT '0' COMMENT '청약 여부',
  `pro_cont_date` date NOT NULL,
  `pro_contractor` varchar(20) NOT NULL COMMENT '청약자명',
  `pro_cont_tel_1` varchar(15) NOT NULL COMMENT '청약자연락처1',
  `pro_cont_tel_2` varchar(15) NOT NULL COMMENT '청약자연락처2',
  `pro_deposit` int(8) NOT NULL COMMENT '청약금',
  `pro_due_date` date NOT NULL COMMENT '계약 예정일',
  `cancel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '해지신청',
  `refund` tinyint(1) NOT NULL DEFAULT '0' COMMENT '환불처리',
  `is_contract` tinyint(1) NOT NULL DEFAULT '0' COMMENT '계약 여부',
  `cont_date` date NOT NULL COMMENT '계약 체결일',
  `contractor` varchar(20) NOT NULL COMMENT '계약자명',
  `cont_tel_1` varchar(15) NOT NULL COMMENT '계약자연락처1',
  `cont_tel_2` varchar(15) NOT NULL COMMENT '계약자연락처2',
  `cont_id_addr` varchar(150) NOT NULL COMMENT '주민등록상 주소',
  `cont_dm_addr` varchar(150) NOT NULL COMMENT '우편수령 주소',
  `doc_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '각서묶음 미비여부',
  `doc_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '주민등본 미비여부',
  `doc_3` tinyint(1) NOT NULL DEFAULT '0' COMMENT '주민초본 미비여부',
  `doc_4` tinyint(1) NOT NULL DEFAULT '0' COMMENT '가족관계등록부 미비여부',
  `doc_5` tinyint(1) NOT NULL DEFAULT '0' COMMENT '인감증명서 미비여부',
  `doc_6` tinyint(1) NOT NULL DEFAULT '0' COMMENT '사용인감(막도장) 미비여부',
  `doc_7` tinyint(1) NOT NULL DEFAULT '0' COMMENT '신분증 미비여부',
  `doc_8` tinyint(1) NOT NULL DEFAULT '0' COMMENT '배우자 등본 미비여부',
  `charge_1` int(10) NOT NULL COMMENT '업무대행비1차',
  `charge_1_date` date NOT NULL COMMENT '업무대행비1차 입금일',
  `charge_1_who` varchar(10) NOT NULL COMMENT '업무대행비1차 입금자',
  `charge_2` int(10) NOT NULL COMMENT '업무대행비 2차',
  `charge_2_date` date NOT NULL COMMENT '업무대행비 2차 입금일',
  `charge_2_who` varchar(10) NOT NULL COMMENT '업무대행비 2차 입금자',
  `charge_3` int(10) NOT NULL COMMENT '업무대행비 3차',
  `charge_3_date` date NOT NULL COMMENT '업무대행비 3차 입금일',
  `charge_3_who` varchar(10) NOT NULL COMMENT '업무대행비 3차 입금자',
  `charge_4` int(10) NOT NULL,
  `charge_4_date` date NOT NULL,
  `charge_4_who` varchar(10) NOT NULL,
  `deposit_1st_1` int(10) NOT NULL COMMENT '1차 계약금1',
  `deposit_1st_1_date` date NOT NULL COMMENT '1차 계약금1 입금일',
  `deposit_1st_1_who` varchar(10) NOT NULL COMMENT '1차 계약금1 입금자',
  `deposit_1st_2` int(10) NOT NULL COMMENT '1차 계약금2',
  `deposit_1st_2_date` date NOT NULL COMMENT '1차 계약금2 입금일',
  `deposit_1st_2_who` varchar(10) NOT NULL COMMENT '1차 계약금2 입금자',
  `deposit_1st_3` int(10) NOT NULL COMMENT '1차 계약금3',
  `deposit_1st_3_date` date NOT NULL COMMENT '1차 계약금3 입금일',
  `deposit_1st_3_who` varchar(10) NOT NULL COMMENT '1차 계약금3 입금자',
  `cont_mgm_who` varchar(20) NOT NULL COMMENT '엠지엠 수령자',
  `cont_mgm_sum` int(5) NOT NULL COMMENT '엠지엠 금액',
  `worker_where` varchar(10) NOT NULL COMMENT '계약담당 소속',
  `cont_worker` varchar(20) NOT NULL COMMENT '계약 담당자',
  `deposit_2nd_1` int(10) NOT NULL COMMENT '2차 계약금1',
  `deposit_2nd_1_date` date NOT NULL COMMENT '2차 계약금1 입금일',
  `deposit_2nd_1_who` varchar(10) NOT NULL COMMENT '2차 계약금1 입금자',
  `deposit_2nd_2` int(10) NOT NULL COMMENT '2차 계약금2',
  `deposit_2nd_2_date` date NOT NULL COMMENT '2차 계약금2 입금일',
  `deposit_2nd_2_who` varchar(10) NOT NULL COMMENT '2차 계약금2 입금자',
  `deposit_2nd_3` int(10) NOT NULL COMMENT '2차 계약금3',
  `deposit_2nd_3_date` date NOT NULL COMMENT '2차 계약금3 입금일',
  `deposit_2nd_3_who` varchar(10) NOT NULL COMMENT '2차 계약금3 입금자',
  `deposit_3rd_1` int(10) NOT NULL COMMENT '3차 계약금1',
  `deposit_3rd_1_date` date NOT NULL COMMENT '3차 계약금1 입금일',
  `deposit_3rd_1_who` varchar(10) NOT NULL COMMENT '3차 계약금1 입금자',
  `deposit_3rd_2` int(10) NOT NULL COMMENT '3차 계약금2',
  `deposit_3rd_2_date` date NOT NULL COMMENT '3차 계약금2 입금일',
  `deposit_3rd_2_who` varchar(10) NOT NULL COMMENT '3차 계약금2 입금자',
  `deposit_3rd_3` int(10) NOT NULL COMMENT '3차 계약금3',
  `deposit_3rd_3_date` date NOT NULL COMMENT '3차 계약금3 입금일',
  `deposit_3rd_3_who` varchar(10) NOT NULL COMMENT '3차 계약금3 입금자',
  `deposit_4th_1` int(10) NOT NULL COMMENT '4차 계약금1',
  `deposit_4th_1_date` date NOT NULL COMMENT '4차 계약금1 입금일',
  `deposit_4th_1_who` varchar(10) NOT NULL COMMENT '4차 계약금1 입금자',
  `deposit_4th_2` int(10) NOT NULL COMMENT '4차 계약금2',
  `deposit_4th_2_date` date NOT NULL COMMENT '4차 계약금2 입금일',
  `deposit_4th_2_who` varchar(10) NOT NULL COMMENT '4차 계약금2 입금자',
  `deposit_4th_3` int(10) NOT NULL COMMENT '4차 계약금3',
  `deposit_4th_3_date` date NOT NULL COMMENT '4차 계약금3 입금일',
  `deposit_4th_3_who` varchar(10) NOT NULL COMMENT '4차 계약금3 입금자',
  `m_pay_1st_1` int(10) NOT NULL COMMENT '1차 중도금1',
  `m_pay_1st_1_date` date NOT NULL COMMENT '1차 중도금1 입금일',
  `m_pay_1st_1_who` varchar(10) NOT NULL COMMENT '1차 중도금1 입금자',
  `m_pay_1st_2` int(10) NOT NULL COMMENT '1차 중도금2',
  `m_pay_1st_2_date` date NOT NULL COMMENT '1차 중도금2 입금일',
  `m_pay_1st_2_who` varchar(10) NOT NULL COMMENT '1차 중도금2 입금자',
  `m_pay_1st_3` int(10) NOT NULL COMMENT '1차 중도금3',
  `m_pay_1st_3_date` date NOT NULL COMMENT '1차 중도금3 입금일',
  `m_pay_1st_3_who` varchar(10) NOT NULL COMMENT '1차 중도금3 입금자',
  `m_pay_2nd_1` int(10) NOT NULL COMMENT '2차 중도금1',
  `m_pay_2nd_1_date` date NOT NULL COMMENT '2차 중도금1 입금일',
  `m_pay_2nd_1_who` varchar(10) NOT NULL COMMENT '2차 중도금1 입금자',
  `m_pay_2nd_2` int(10) NOT NULL COMMENT '2차 중도금2',
  `m_pay_2nd_2_date` date NOT NULL COMMENT '2차 중도금2 입금일',
  `m_pay_2nd_2_who` varchar(10) NOT NULL COMMENT '2차 중도금2 입금자',
  `m_pay_2nd_3` int(10) NOT NULL COMMENT '2차 중도금3',
  `m_pay_2nd_3_date` date NOT NULL COMMENT '2차 중도금3 입금일',
  `m_pay_2nd_3_who` varchar(10) NOT NULL COMMENT '2차 중도금3 입금자',
  `m_pay_3rd_1` int(10) NOT NULL COMMENT '3차 중도금1',
  `m_pay_3rd_1_date` date NOT NULL COMMENT '3차 중도금1 입금일',
  `m_pay_3rd_1_who` varchar(10) NOT NULL COMMENT '3차 중도금1 입금자',
  `m_pay_3rd_2` int(10) NOT NULL COMMENT '3차 중도금2',
  `m_pay_3rd_2_date` date NOT NULL COMMENT '3차 중도금2 입금일',
  `m_pay_3rd_2_who` varchar(10) NOT NULL COMMENT '3차 중도금2 입금자',
  `m_pay_3rd_3` int(10) NOT NULL COMMENT '3차 중도금3',
  `m_pay_3rd_3_date` date NOT NULL COMMENT '3차 중도금3 입금일',
  `m_pay_3rd_3_who` varchar(10) NOT NULL COMMENT '3차 중도금3 입금자',
  `m_pay_4th_1` int(10) NOT NULL COMMENT '4차 중도금1',
  `m_pay_4th_1_date` date NOT NULL COMMENT '4차 중도금1 입금일',
  `m_pay_4th_1_who` varchar(10) NOT NULL COMMENT '4차 중도금1 입금자',
  `m_pay_4th_2` int(10) NOT NULL COMMENT '4차 중도금2',
  `m_pay_4th_2_date` date NOT NULL COMMENT '4차 중도금2 입금일',
  `m_pay_4th_2_who` varchar(10) NOT NULL,
  `m_pay_4th_3` int(10) NOT NULL,
  `m_pay_4th_3_date` date NOT NULL,
  `m_pay_4th_3_who` varchar(10) NOT NULL,
  `m_pay_5th_1` int(10) NOT NULL,
  `m_pay_5th_1_date` date NOT NULL,
  `m_pay_5th_1_who` varchar(10) NOT NULL,
  `m_pay_5th_2` int(10) NOT NULL,
  `m_pay_5th_2_date` date NOT NULL,
  `m_pay_5th_2_who` varchar(10) NOT NULL,
  `m_pay_5th_3` int(10) NOT NULL,
  `m_pay_5th_3_date` date NOT NULL,
  `m_pay_5th_3_who` varchar(10) NOT NULL,
  `m_pay_6th_1` int(10) NOT NULL,
  `m_pay_6th_1_date` date NOT NULL,
  `m_pay_6th_1_who` varchar(10) NOT NULL,
  `m_pay_6th_2` int(10) NOT NULL,
  `m_pay_6th_2_date` date NOT NULL,
  `m_pay_6th_2_who` varchar(10) NOT NULL,
  `m_pay_6th_3` int(10) NOT NULL,
  `m_pay_6th_3_date` date NOT NULL,
  `m_pay_6th_3_who` varchar(10) NOT NULL,
  `m_pay_7th_1` int(10) NOT NULL,
  `m_pay_7th_1_date` date NOT NULL,
  `m_pay_7th_1_who` varchar(10) NOT NULL,
  `m_pay_7th_2` int(10) NOT NULL,
  `m_pay_7th_2_date` date NOT NULL,
  `m_pay_7th_2_who` varchar(10) NOT NULL,
  `m_pay_7th_3` int(10) NOT NULL,
  `m_pay_7th_3_date` date NOT NULL,
  `m_pay_7th_3_who` varchar(10) NOT NULL,
  `last_pay_1` int(10) NOT NULL,
  `last_pay_1_date` date NOT NULL,
  `last_pay_1_who` varchar(10) NOT NULL,
  `last_pay_2` int(10) NOT NULL,
  `last_pay_2_date` date NOT NULL,
  `last_pay_2_who` varchar(10) NOT NULL,
  `last_pay_3` int(10) NOT NULL,
  `last_pay_3_date` date NOT NULL,
  `last_pay_3_who` varchar(10) NOT NULL,
  `note` text NOT NULL COMMENT '비고',
  `is_except` tinyint(1) NOT NULL COMMENT '기분양세대여부',
  `price_ho` int(7) NOT NULL COMMENT '공급가격',
  `pay_ho` int(6) NOT NULL COMMENT '호당 수수료',
  `updater` varchar(10) NOT NULL COMMENT '기록담당 직원',
  `reg_time` datetime NOT NULL COMMENT '등록시간',
  PRIMARY KEY (`seq`),
  KEY `pro_contractor` (`pro_contractor`),
  KEY `contractor` (`contractor`),
  KEY `cont_worker` (`cont_worker`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='프로젝트 진행 데이터 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 17. 현장 정보 디비
///////////////////////////////////////////////////////////////////////////

$project_if_tb="cms_project_info"; // 
$project_if_tb_schema = "

CREATE TABLE IF NOT EXISTS `$project_if_tb` (
  `seq` int(10) NOT NULL AUTO_INCREMENT,
  `pj_name` varchar(50) NOT NULL,
  `sort` int(2) NOT NULL,
  `data_cr` tinyint(1) NOT NULL,
  `is_data_reg` tinyint(1) NOT NULL DEFAULT '0',
  `local_addr` varchar(100) NOT NULL,
  `local_tel` varchar(15) NOT NULL,
  `local_fax` varchar(15) NOT NULL,
  `pj_manager` varchar(20) NOT NULL,
  `type_info` varchar(120) NOT NULL,
  `color_type` varchar(87) NOT NULL,
  `total_count_type` varchar(120) NOT NULL,
  `sell_count_type` varchar(120) NOT NULL,
  `count_unit` varchar(22) NOT NULL,
  `per_pay_type` varchar(120) NOT NULL,
  `pay_con` varchar(22) NOT NULL,
  `client` varchar(20) NOT NULL,
  `client_res` varchar(20) NOT NULL,
  `client_res_tel` varchar(15) NOT NULL,
  `client_res_mail` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `cont_date` date NOT NULL,
  `pay_sp_condition` text NOT NULL,
  `is_end` bit(1) NOT NULL COMMENT '종료한 경우 ''1'' 입력',
  `reg_date` date NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `pj_name` (`pj_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='현장 프로젝트 정보 테이블' ;

";


////////////////////////////////////////////////////////////////////////////
// 18. 현장 인원 본부 정보
///////////////////////////////////////////////////////////////////////////

$resource_h_tb_schema = "

CREATE TABLE IF NOT EXISTS `$resource_h_tb` (
  `seq` int(5) NOT NULL AUTO_INCREMENT,
  `pj_seq` int(7) NOT NULL,
  `headq` varchar(20) NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `headq` (`headq`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='현장별 본부 등록 테이블' ;

";

////////////////////////////////////////////////////////////////////////////
// 19. 현장 인원 팀 정보
///////////////////////////////////////////////////////////////////////////

$resource_t_tb_schema = "

CREATE TABLE IF NOT EXISTS `$resource_t_tb` (
  `seq` int(5) NOT NULL AUTO_INCREMENT,
  `pj_seq` int(7) NOT NULL,
  `headq_seq` int(2) NOT NULL,
  `team` varchar(20) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='현장 본부별 팀 등록 테이블' ;

";

////////////////////////////////////////////////////////////////////////////
// 20. 현장 인원 팀원 정보
///////////////////////////////////////////////////////////////////////////

$resource_m_tb_schema = "

CREATE TABLE IF NOT EXISTS `$resource_m_tb` (
  `seq` int(7) NOT NULL AUTO_INCREMENT,
  `pj_seq` int(5) NOT NULL,
  `headq_seq` int(2) NOT NULL,
  `team_seq` int(2) NOT NULL,
  `position` int(1) NOT NULL,
  `name` varchar(20) NOT NULL,
  `id_num` varchar(14) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `bank_acc` varchar(20) NOT NULL,
  `bank_acc_num` varchar(30) NOT NULL,
  `bank_acc_holder` varchar(20) NOT NULL,
  `join_date` date NOT NULL COMMENT '입사일',
  `is_retire` tinyint(1) NOT NULL DEFAULT '0',
  `retire_date` date NOT NULL COMMENT '퇴사일',
  PRIMARY KEY (`seq`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='영업 직원 명단 테이블' ;

";

////////////////////////////////////////////////////////////////////////////
// 21. 재고 1차 분류
///////////////////////////////////////////////////////////////////////////

$stock_d1_tb_schema = "

CREATE TABLE IF NOT EXISTS `$stock_d1_tb` (
  `no` int(20) NOT NULL AUTO_INCREMENT,
  `classify` varchar(50) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

////////////////////////////////////////////////////////////////////////////
// 22. 재고 2차 분류
///////////////////////////////////////////////////////////////////////////

$stock_d2_tb_schema = "

CREATE TABLE IF NOT EXISTS `$stock_d2_tb` (
  `no` int(20) NOT NULL AUTO_INCREMENT,
  `1st_classify` varchar(50) NOT NULL DEFAULT '',
  `classify` varchar(50) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

////////////////////////////////////////////////////////////////////////////
// 23. 재고 3차 분류
///////////////////////////////////////////////////////////////////////////

$stock_d3_tb_schema = "

CREATE TABLE IF NOT EXISTS `$stock_d3_tb` (
  `no` int(20) NOT NULL AUTO_INCREMENT,
  `1st_classify` varchar(50) NOT NULL DEFAULT '',
  `2nd_classify` varchar(50) NOT NULL DEFAULT '',
  `classify` varchar(50) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

";

////////////////////////////////////////////////////////////////////////////
// 24. 재고 4차 분류
///////////////////////////////////////////////////////////////////////////

$stock_d4_tb_schema = "

CREATE TABLE IF NOT EXISTS `$stock_d4_tb` (
  `no` int(20) NOT NULL AUTO_INCREMENT,
  `1st_classify` varchar(50) NOT NULL DEFAULT '',
  `2nd_classify` varchar(50) NOT NULL DEFAULT '',
  `3rd_classify` varchar(50) NOT NULL DEFAULT '',
  `classify` varchar(50) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `reg_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

";

////////////////////////////////////////////////////////////////////////////
// 25. 재고 메인
///////////////////////////////////////////////////////////////////////////

$stock_main_tb_schema = "

CREATE TABLE IF NOT EXISTS `$stock_main_tb` (
  `seq_num` int(20) NOT NULL AUTO_INCREMENT,
  `division` int(2) NOT NULL DEFAULT '0',
  `classify` int(2) NOT NULL DEFAULT '0',
  `category` varchar(20) NOT NULL DEFAULT '',
  `brand` varchar(30) NOT NULL DEFAULT '',
  `style` varchar(50) NOT NULL DEFAULT '',
  `color` varchar(30) NOT NULL DEFAULT '',
  `comp` varchar(50) NOT NULL DEFAULT '',
  `qty` int(10) NOT NULL DEFAULT '0',
  `price_in` int(20) NOT NULL DEFAULT '0',
  `set_price` int(20) NOT NULL DEFAULT '0',
  `price_out` int(20) NOT NULL DEFAULT '0',
  `accounts` int(10) NOT NULL DEFAULT '0',
  `worker` varchar(20) NOT NULL DEFAULT '',
  `st_date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`seq_num`),
  KEY `style` (`style`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='재고 현황 정보 테이블' ;

";

////////////////////////////////////////////////////////////////////////////
// 26. 세무서 정보
///////////////////////////////////////////////////////////////////////////

$tax_office_tb_schema = "

CREATE TABLE IF NOT EXISTS `$tax_office_tb` (
  `no` int(3) NOT NULL DEFAULT '0',
  `chung` varchar(10) NOT NULL DEFAULT '',
  `office` varchar(10) NOT NULL DEFAULT '',
  `code` char(3) NOT NULL DEFAULT '',
  `account` varchar(10) NOT NULL DEFAULT '',
  `zipcode` varchar(7) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `tel` varchar(13) NOT NULL DEFAULT '',
  `fax` varchar(13) NOT NULL DEFAULT '',
  `jurisdic` text NOT NULL,
  UNIQUE KEY `code` (`code`),
  KEY `office` (`office`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='전국 세무서 정보';

";

$tax_office_tb_insert_schema = "

INSERT INTO `$tax_office_tb` (`no`, `chung`, `office`, `code`, `account`, `zipcode`, `address`, `tel`, `fax`, `jurisdic`) VALUES
(1, '서울청', '서울청', '100', '11895', '1107-05', '서울 종로구 종로5길 86', '02-397-2200', '02-722-0528', '서울특별시'),
(2, '서울청', '종로', '101', '11976', '110-310', '서울 종로구 삼일대로 451 라이온스회관', '02-760-9200', '02-744-4939', '종로구 전역(87개동)'),
(3, '서울청', '남대문', '104', '11785', '100-769', '서울 중구 삼일대로 340 나라키움빌딩', '02-2260-0200', '02-755-7114', '소공동 남창동(남대문시장) 북창동 회현동1-3가 봉래동1,2가 남대문로1,3,4,5가, 태평로1,2가, 저동1,2가, 을지로1-5가,삼각동, 수하동장, 교동, 산림동, 다동,무교동, 수표동, 주교동, 정동, 서소문동, 의주로1,2가 순화동, 만리동1,2가 , 중림동, 충정로1가'),
(4, '서울청', '마포', '105', '11840', '121-712', '서울 마포구 독막길 99-1', '02-705-7200', '', '마포구 전역(행정동 24개)'),
(5, '서울청', '용산', '106', '11947', '140-705', '서울 용산구 서빙고로24길 15', '02-748-8200', '02-792-2619', '용산구 전체'),
(6, '서울청', '영등포', '107', '11934', '150-955', '서울 영등포구 선유동1로 38', '02-2630-9200', '02-2678-4909', '영등포구(신길동, 도림동, 대림동 제외)'),
(7, '서울청', '동작', '108', '181', '150-050', '서울 영등포구 대방천로 261', '02-840-9200', '02-831-4137', '서울특별시 동작구 전체, 영등포구 중 신길동, 대림동, 도림동'),
(8, '서울청', '강서', '109', '12027', '150-965', '서울 영등포구 선유로 243', '02-2630-4200', '02-2679-8777', '강서구 전체'),
(9, '서울청', '서대문', '110', '11879', '120-785', '서울 서대문구 세무서길11', '02-2287-4200', '02-379-0552', '서대문구, 은평구 전체'),
(10, '서울청', '구로', '113', '11756', '150-954', '서울 영등포구 경인로 778', '02-2630-7200', '02-2631-8958', '구로구 전체(신도림동등 19개동)'),
(11, '서울청', '반포', '114', '180645', '137-708', '서울 서초구 방배로 163', '02-590-4200', '02-536-4083', '서초구 방배동,  반포동,  잠원동'),
(12, '서울청', '양천', '117', '12878', '158-704', '서울 양천구 목동동로 165', '02-2650-9200', '02-2652-0058', '양천구 전체'),
(13, '서울청', '금천', '119', '14371', '153-703', '서울 금천구 시흥대로152길 11-21', '02-850-4200', '02-861-1475', '관악구, 금천구 전체'),
(14, '서울청', '삼성', '120', '181149', '135-753', '서울 강남구 테헤란로 114 국세청고객만족센터 5,6층', '02-3011-7200', '02-564-1129', '강남구 삼성동,대치동,개포동,수서,일원, 세곡, 자곡, 율현동'),
(15, '서울청', '중부', '201', '11989', '100-795', '서울 중구 퇴계로 170', '02-2260-9200', '02-2278-0582', '광희동 1,2가,  남대문로 2가,  남산동 1,2,3가,  남학동,  명동 1,2가,  무학동,  묵정동,  방산동,  신당1동∼6동,  쌍림동,  예관동,  예장동,  오장동,  을지로 6,7가,  인현동 1,2가,  장충동 1,2가,  주자동,  초동,  충무로 1,2,3,4,5가,  필동 1,2,3가,  황학동,  흥인동.'),
(16, '서울청', '동대문', '204', '11824', '130-704', '서울 동대문구 약령시로 159', '02-958-0200', '02-967-7593', '동대문구, 중랑구 전체'),
(17, '서울청', '성동', '206', '11905', '133-703', '서울 성동구 광나루로 297', '02-460-4200', '02-468-8455', '서울특별시 성동구 · 광진구 전체'),
(18, '서울청', '성북', '209', '11918', '136-708', '서울 성북구 삼선교로16길 13', '02-760-8200', '02-744-6160', '서울특별시 성북구'),
(19, '서울청', '도봉', '210', '11811', '142-702', '서울 강북구 도봉로 117', '02-9440-200', '02-984-2580', '강북구, 도봉구 창동 제외'),
(20, '서울청', '강남', '211', '180616', '135-951', '서울 강남구 학동로 425', '02-519-4200', '02-512-3917', '강남구 중 신사동, 압구정동, 논현동, 청담동'),
(21, '서울청', '강동', '212', '180629', '138-750', '서울 송파구 강동대로 62', '02-2224-0200', '02-471-2532', '강동구 전역'),
(22, '서울청', '서초', '214', '180658', '135-753', '서울 강남구 테헤란로 114 국세청고객만족센터 3,4층', '02-3011-6200', '02-563-8030', '서초구 서초동, 양재동, 우면동, 원지동, 염곡동, 신원동, 내곡동'),
(23, '서울청', '송파', '215', '180661', '138-706', '서울  송파구 강동대로 62', '02-2224-9200', '02-409-6939', '서울시 송파구 전체'),
(24, '서울청', '노원', '217', '1562', '132-899', '서울시 도봉구 노해로69길 14', '02-3499-0200', '', '서울특별시 노원구 전지역, 도봉구 중 창동'),
(25, '서울청', '역삼', '220', '181822', '135-753', '서울 강남구 테헤란로 114 국세청고객만족센터 7,8층', '02-3011-8200', '02-561-6684', '강남구 역삼동, 도곡동, 포이동'),
(26, '중부청', '중부청', '200', '165', '440-290', '경기 수원시 장안구 경수대로 1110-17', '031-888-4200', '031-888-7612', '인천광역시, 수원시, 이천시, 안양시, 평택시, 고양시, 부천시, 파주시, 용인시, 춘천시, 삼척시, 홍천군, 원주시, 영월군, 강릉시, 속초시'),
(27, '중부청', '인천', '121', '110259', '401-707', '인천 동구 우각로 75', '032-770-0200', '032-763-9007', '인천광역시 동구, 중구, 남구, 옹진군'),
(28, '중부청', '북인천', '122', '110233', '407-702', '인천 계양구 효서로 244', '032-540-6200', '', '인천광역시 부평구, 계양구'),
(29, '중부청', '남인천', '131', '110424', '405-729', '인천 남동구 인하로 548', '032-460-5200', '032-463-5778', '인천시 남동구, 연수구'),
(30, '중부청', '서인천', '137', '111025', '404-703', '인천 서구 서곶로369번길 17', '032-560-5200', '032-561-5777', '인천광역시 서구 · 강화군,경기도 김포시'),
(31, '중부청', '안양', '123', '130365', '430-719', '경기 안양시 만안구 냉천로 83', '031-467-1200', '031-467-1300', '안양시 만안구, 군포시'),
(32, '중부청', '동안양', '138', '1591', '431-060', '경기 안양시 동안구 관평로202번길 27', '031-389-8200', '031-476-9787', '안양시 동안구, 과천시, 의왕시'),
(33, '중부청', '수원', '124', '130352', '442-785', '경기 수원시 팔달구 매산로 61', '031-250-4200', '031-258-9411', '수원시 권선구 전체 및 팔달구 일부(매산, 매교, 교, 화서, 고등동), 오산시, 화성시'),
(34, '중부청', '동수원', '135', '131157', '443-701', '경기 수원시 영통구 청명남로 13', '031-695-4200', '031-273-2416', '수원시 장안구,팔달구,영통구'),
(35, '중부청', '평택', '125', '130381', '450-704', '경기 평택시 통복시장로16번길 21', '031-650-0200', '031-655-9542', '경기도 평택시, 안성시'),
(36, '중부청', '이천', '126', '130378', '467-800', '경기 이천시 부악로 47', '031-644-0200', '031-634-2103', '이천시, 여주군, 광주시, 하남시'),
(37, '중부청', '의정부', '127', '900142', '480-705', '경기 의정부시 의정로 77', '031-870-4200', '031)875-2736', '경기도 의정부시, 동두천시, 양주시, 포천시, 연천군, 강원도 철원군'),
(38, '중부청', '고양', '128', '12014', '410-741', '경기 고양시 일산동구 중앙로1275번길 14-43', '031-900-9200', '031-907-0674', '고양시'),
(39, '중부청', '성남', '129', '130349', '461-704', '경기 성남시 수정구 희망로 480', '031-730-6200', '031-736-1904', '성남시'),
(40, '중부청', '부천', '130', '110246', '420-706', '경기 부천시 원미구 계남로 227', '032-320-5200', '032-328-6931', '경기도 부천시'),
(41, '중부청', '남양주', '132', '12302', '471-703', '경기 구리시 안골로 36', '031-550-3200', '031-566-1808', '구리시,남양주시,양평군,가평군'),
(42, '중부청', '안산', '134', '131076', '425-704', '경기 안산시 단원구 화랑로 350', '031-412-3200', '031-487-4740', '안산시'),
(43, '중부청', '시흥', '140', '1588', '423-030', '경기도 시흥시 마유로 368', '031-310-7200', '031-314-3973', '경기도 시흥시, 광명시'),
(44, '중부청', '파주', '141', '1575', '413-010', '경기도 파주시 금릉역로 62', '031-956-0200', '031-957-0315', '경기도 파주시 전역'),
(45, '중부청', '용인', '142', '2846', '449-060', '경기도 용인시 처인구 중부대로1161번길 71', '031-329-2200', '', '용인시 전지역'),
(46, '중부청', '화성', '143', '18351', '445-897', '경기 화성시 봉담읍 참샘길 27', '031-8019-1200', '031-8019-8247', '화성시(동탄, 구 태안 제외)'),
(47, '중부청', '분당', '144', '18364', '463-825', '경기 성남시 분당구 황새울로 258번길 29 BS타워(2층~6층)', '031-219-9200', '032-219-9000', '성남시 분당구'),
(48, '중부청', '춘천', '221', '100272', '200-043', '강원 춘천시 중앙로 115', '033-250-0200', '033) 252-3589', '춘천시, 화천군, 양구군'),
(49, '중부청', '삼척', '222', '150167', '245-705', '강원 삼척시 교동로 148', '033-570-0200', '033-574-5788', '삼척시, 동해시, 태백시(태백지서 관할)'),
(50, '중부청', '홍천', '223', '100285', '250-807', '강원 홍천군 홍천읍 생명과학관길 50', '033-430-1200', '033-433-1889', '강원도 홍천군, 인제군'),
(51, '중부청', '원주', '224', '100269', '220-718', '강원 원주시 북원로 2325', '033-740-9200', '033-746-4791', '원주시, 횡성군, 평창군 중 봉평면, 대화면, 방림면'),
(52, '중부청', '영월', '225', '150183', '230-808', '강원 영월군 영월읍 하송안길 49', '033-370-0200', '033-374-2100', '강원도 영월군, 정선군(임계면 제외), 평창군 중 평창읍,미탄면'),
(53, '중부청', '강릉', '226', '150154', '210-921', '강원 강릉시 수리골길 53', '033-610-9200', '033-641-4186', '강릉시. 평창군중 대관령면,진부면,용평면 및 정선군 중 임계면'),
(54, '중부청', '속초', '227', '150170', '217-060', '강원 속초시 수복로 28', '033-639-9200', '033-633-9510', '속초시, 고성군, 양양군'),
(55, '대전청', '대전청', '300', '80499', '306-704', '대전 대덕구 계족로 857', '042-620-3200', '042-621-4552', '대전광역시 및 충청남ㆍ북도'),
(56, '대전청', '청주', '301', '90337', '361-707', '충북 청주시 흥덕구 죽천로 151', '043-230-9200', '043-235-5417', '청주시, 청원, 진천, 괴산군(소수면, 불정면, 장연면, 연풍면, 감물면 제외)'),
(57, '대전청', '영동', '302', '90311', '370-802', '충북 영동군 영동읍 계산로2길 5-6', '043-740-6200', '043-740-6250', '영동군, 옥천군, 보은군'),
(58, '대전청', '충주', '303', '90340', '380-230', '충북 충주시 충원대로 724', '043-841-6200', '043-845-3320', '충주시, 음성군, 괴산군 일부(불정, 연풍, 소수, 감물, 장연면)'),
(59, '대전청', '제천', '304', '90324', '390-150', '충북 제천시 내토로41길 8', '043-649-2200', '043-648-3586', '제천시, 단양군'),
(60, '대전청', '대전', '305', '80486', '301-707', '대전 중구 보문로 331', '042-229-8200', '042-253-4990', '대전광역시 동구, 중구, 대덕구 중 오정, 대화, 읍내, 연축, 신대, 와, 송촌, 법동, 중리동, 비래동, 장동, 충청남도 금산군'),
(61, '대전청', '공주', '307', '80460', '314-800', '충남 공주시 봉황로 113', '041-850-3200', '041-850-3691', '충청남도 공주시 , 연기군'),
(62, '대전청', '논산', '308', '80473', '320-702', '충남 논산시 논산대로241번길 6', '041-730-8200', '041-733-3137', '충청남도 논산시, 부여군'),
(63, '대전청', '홍성', '310', '930170', '350-804', '충남 홍성군 홍성읍 홍덕서로 32', '041-630-4200', '041-632-9964', '홍성군. 청양군'),
(64, '대전청', '예산', '311', '930167', '340-809', '충남 예산군 예산읍 주교로 64', '041-330-5200', '041-335-2003', '예산군, 당진군'),
(65, '대전청', '천안', '312', '935188', '330-703', '충남 천안시 동남구 청수14로 80', '041-5598-200', '041-555-9556', '충청남도 천안시,아산시'),
(66, '대전청', '보령', '313', '930154', '355-070', '충남 보령시 옥마로 56', '041-930-9200', '041-936-7289', '충청남도 보령시,서천군'),
(67, '대전청', '서대전', '314', '81197', '302-706', '대전 서구 둔산서로 70', '042-480-8200', '042-486-8067', '대전광역시 서구, 유성구 전체, 대덕구중 상서동, 평촌동, 덕암동, 신일동, 목상, 문평, 석봉, 신탄진, 이현, 갈전, 용호, 부수, 황호, 삼정, 미호동'),
(68, '대전청', '서산', '316', '602', '356-030', '충남 서산시 덕지천로 145-6', '041-660-9200', '041-666-0375', '충청남도 서산시, 태안군'),
(69, '대전청', '동청주', '317', '2859', '360-714', '충북 청주시 상당구 상당로 195 대한생명빌딩 5-6층', '043-229-4200', '043-229-4601', '청주시 상당구, 청원군, 괴산군(괴산읍, 문광, 사리, 청안, 청천, 칠성면)'),
(70, '광주청', '광주청', '400', '60707', '500-901', '광주 북구 첨단과기로 208번길 43', '062-370-5200', '062-371-7500', '광주광역시, 전라남도, 전라북도 전체'),
(71, '광주청', '군산', '401', '70399', '573-400', '전북 군산시 해망로 583', '063-470-3200', '063-468-2100', '군산시'),
(72, '광주청', '전주', '402', '70438', '560-870', '전북 전주시 완산구 서곡로 95', '063-250-0200', '063-277-7708', '전주시 완산구,완주군'),
(73, '광주청', '익산', '403', '70425', '570-759', '전북 익산시 익산대로52길 19', '063-840-0200', '063-851-0305', '익산시, 김제시'),
(74, '광주청', '정읍', '404', '70441', '580-758', '전북 정읍시 중앙1길 93', '063-530-1200', '063-533-9101', '정읍시, 고창군, 부안군'),
(75, '광주청', '남원', '407', '70412', '590-010', '전북 남원시 광한북로 94-23', '063-630-2200', '063-632-7302', '남원시, 임실군, 순창군, 장수군 일부(장수읍, 산서, 번암)'),
(76, '광주청', '광주', '408', '60639', '501-120', '광주 동구 중앙로 154', '062-605-0200', '062-225-4701', '광주광역시 동구,남구,  전남 화순군,곡성군'),
(77, '광주청', '북광주', '409', '60671', '500-705', '광주 북구 금호로 70', '062-520-9200', '062-528-7619', '광주광역시 북구, 장성군, 담양군 전체'),
(78, '광주청', '서광주', '410', '60655', '502-706', '광주 서구 상무민주로 6번길 31', '062-380-5200', '062-371-4701', '광주광역시 서구,광산구, 전라남도 영광군'),
(79, '광주청', '목포', '411', '50144', '530-704', '전남 목포시 호남로 58번길 19', '061-241-1200', '061-244-5915', '전라남도 목포시, 무안군, 신안군, 영암군 중 삼호읍'),
(80, '광주청', '나주', '412', '60642', '520-130', '전남 나주 재신길 33', '061-330-0200', '061-332-8583', '나주시, 영암군(삼호면 제외), 함평군'),
(81, '광주청', '해남', '415', '50157', '536-800', '전남 해남군 해남읍 중앙1로 18', '061-530-6200', '061-536-6074', '해남군, 완도군, 진도군, 강진군, 장흥군'),
(82, '광주청', '순천', '416', '920300', '540-712', '전남 순천시 연향번영길 64', '061-720-0200', '061-723-6677', '전라남도 순천시, 광양시, 구례군, 보성군, 고흥군'),
(83, '광주청', '여수', '417', '920313', '555-712', '전남 여수시 좌수영로 948-5', '061-688-0200', '061-682-1649', '여수시'),
(84, '광주청', '북전주', '418', '2862', '561-837', '전주시 덕진구 벚꽃로 33', '063-249-1200', '063-249-1680', '전주시 덕진구, 진안군, 무주군, 장수군 일부(천천, 계남, 계북, 장계면)'),
(85, '대구청', '대구청', '500', '40756', '702-053', '대구 북구 원대로 118', '053-350-1200', '053-351-6218', '대구광역시, 경주시, 포항시, 영덕군, 안동군, 김천시, 상주시, 영주시, 구미시, 경산시'),
(86, '대구청', '동대구', '502', '40769', '701-827', '대구 동구 국채보상로 895', '053-749-0200', '053-756-8837', '대구광역시 동구 , 수성구 전체'),
(87, '대구청', '서대구', '503', '40798', '704-911', '대구 달서구 당산로38길 33', '053-659-1200', '053-627-6121', '대구광역시 서구 전체, 경상북도 고령군 전체, 대구광역시 달서구 갈산동, 감삼동, 두류동, 본리동, 성당동, 신당동, 용산동, 이곡동, 장기동, 장동, 죽전동, 파산동, 파호동, 호림동'),
(88, '대구청', '북대구', '504', '40772', '702-857', '대구 북구 원대로 124', '053-350-4200', '053-354-4190', '대구광역시 북구, 중구'),
(89, '대구청', '경주', '505', '170176', '780-947', '경북 경주시 원화로 335', '054-779-1200', '054-743-4408', '경주시, 영천시 전체'),
(90, '대구청', '포항', '506', '170192', '791-703', '경북 포항시 북구 중앙로 346', '054-245-2200', '054-248-4040', '포항시, 울릉군'),
(91, '대구청', '영덕', '507', '170189', '766-805', '경북 영덕군 영덕읍 영덕로 35-11', '054-730-2200', '054-730-2504', '영덕군,울진군'),
(92, '대구청', '안동', '508', '910365', '760-050', '경북 안동시 서동문로 208', '054-851-0200', '054-859-6177', '안동시, 의성군, 군위군, 청송군, 영양군'),
(93, '대구청', '김천', '510', '905257', '740-708', '경북 김천시 평화길 128', '054-420-3200', '054-430-6605', '김천시, 성주군'),
(94, '대구청', '상주', '511', '905260', '742-260', '경북 상주시 경상대로 3173-11', '054-530-0200', '054-534-9026', '경상북도 상주시, 문경시'),
(95, '대구청', '영주', '512', '910378', '750-021', '경북 영주시 중앙로 15', '054-639-5200', '054-633-0954', '경북 영주시, 봉화군, 예천군 전지역'),
(96, '대구청', '구미', '513', '905244', '730-902', '경북 구미시 수출대로 179', '054-468-4200', '054-464-0537', '경상북도 구미시, 칠곡군'),
(97, '대구청', '남대구', '514', '40730', '705-790', '대구 남구 대명로 55', '053-659-0200', '053-627-0157', '대구광역시, 남구, 달성군, 달서구(월성동, 대천동, 월암동, 상인동, 도원동, 진천동, 대곡동, 유천동, 송현동, 본동)'),
(98, '대구청', '경산', '515', '42330', '712-704', '경북 경산시 박물관로 3', '053-819-3200', '053-802-8300', '경산시, 청도군'),
(99, '부산청', '부산청', '600', '30517', '611-738', '부산 연제구 연제로 12', '051-750-7200', '051-759-8400', '부산광역시,울산광역시,경상남도,제주도'),
(100, '부산청', '중부산', '602', '30562', '600-803', '부산 중구 흑교로 64', '051-240-0200', '051-241-6009', '중구: 광복,남포,대창,대청,동광,보수,부평,신창동,영주동,중앙동,창선동 영도구: 남항,대교,동삼동,대평동,봉래동,신선동,영선동,청학동'),
(101, '부산청', '서부산', '603', '30546', '602-061', '부산 서구 구덕로 187 KT서부산지사', '051-250-6200', '051-241-7004', '부산광역시 서구, 사하구'),
(102, '부산청', '부산진', '605', '30520', '601-722', '부산 동구 진성로 23', '051-461-9200', '051-464-9552', '부산광역시 부산진구,동구'),
(103, '부산청', '북부산', '606', '30533', '617-800', '부산 사상구 대동로 290 LS산전㈜빌딩 1,3,4,6층', '051-310-6200', '051-328-0045', '부산광역시 강서구, 북구, 사상구'),
(104, '부산청', '동래', '607', '30481', '611-707', '부산 연제구 거제천로269번길 16', '051-860-2200', '051-866-6252', '부산광역시중 동래구, 연제구'),
(105, '부산청', '마산', '608', '140672', '631-707', '경남 창원시 마산합포구 3·15대로 211', '055-240-0200', '055-223-6881', '마산시, 함안군, 의령군, 창녕군'),
(106, '부산청', '창원', '609', '140669', '641-720', '경남 창원시 의창구 중앙대로209번길 16', '055-239-0200', '055-287-1394', '경상남도 창원시, 진해시 전지역'),
(107, '부산청', '울산', '610', '160021', '680-702', '울산 남구 갈밭로 49', '052-259-0200', '052-273-2100', '울산광역와 울주군 중 동울산세무서 제외'),
(108, '부산청', '거창', '611', '950419', '670-807', '경남 거창군 거창읍 상동2길 14', '055-940-0200', '055-942-3616', '경남 거창군, 함양군, 합천군'),
(109, '부산청', '통영', '612', '140708', '650-801', '경남 통영시 무전5길 20-9', '055-640-7200', '055-644-1814', '통영시, 거제시, 고성군'),
(110, '부산청', '진주', '613', '950435', '660-230', '경남 진주시 진주대로908번길 15', '055-751-0200', '055-753-9009', '진주시, 사천시, 산청군, 하동군, 남해군 전체'),
(111, '부산청', '김해', '615', '178', '621-703', '경남 김해시 호계로 440', '055-320-6200', '055-335-2250', '경상남도 김해시, 밀양시 전체'),
(112, '부산청', '제주', '616', '120171', '690-755', '제주 제주시 청사로 59', '064-720-5200', '064-724-1107', '제주도 전체'),
(113, '부산청', '수영', '617', '30478', '611-813', '부산 연제구 토곡로 20', '051-620-9200', '051-621-2593', '남구전체, 수영구전체, 해운대구전체'),
(114, '부산청', '동울산', '620', '1601', '683-300', '울산광역시 북구 사청2길 7', '052-219-9200', '052-289-8366', '울산광역시 중구,동구,북구 울주군중 언양읍,범서읍 상북,삼남,삼동 두동 두서면'),
(115, '부산청', '금정', '621', '31794', '609-703', '부산 금정시 중앙대로 1636', '051-580-6200', '051-516-8272', '부산광역시 금정구, 기장군, 경상남도 양산시');

";

////////////////////////////////////////////////////////////////////////////
// 27. 상담일지 기록
///////////////////////////////////////////////////////////////////////////

$work_coun_log_tb_schema = "

CREATE TABLE IF NOT EXISTS `$work_coun_log_tb` (
  `seq` int(7) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(20) NOT NULL,
  `cust_tel1` varchar(13) NOT NULL,
  `cust_tel2` varchar(13) NOT NULL,
  `coun_route` int(1) NOT NULL COMMENT '상담경로',
  `favor_type` varchar(30) NOT NULL,
  `live_where` varchar(30) NOT NULL,
  `inte_degree` int(1) NOT NULL,
  `content` text NOT NULL,
  `memo` varchar(50) NOT NULL,
  `coun_date` date NOT NULL,
  `worker_id` varchar(30) NOT NULL,
  `worker_name` varchar(20) NOT NULL,
  `worker_where` varchar(20) NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `cust_name` (`cust_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

////////////////////////////////////////////////////////////////////////////
// 28. 업무일지 기록
///////////////////////////////////////////////////////////////////////////

$work_log_tb_schema = "

CREATE TABLE IF NOT EXISTS `$work_log_tb` (
  `seq` int(6) NOT NULL AUTO_INCREMENT,
  `pj_seq` int(5) NOT NULL,
  `writer` varchar(20) NOT NULL,
  `pj_where` varchar(10) NOT NULL,
  `work_date` date NOT NULL,
  `work_num` int(3) NOT NULL,
  `pro_cont_num` int(3) NOT NULL,
  `pro_cont_c_num` int(2) NOT NULL COMMENT '청약해지 수',
  `cont_num` int(3) NOT NULL,
  `co_sort` varchar(23) NOT NULL COMMENT '청약/해지/계약 구분',
  `c_cust_name` varchar(120) NOT NULL,
  `dong_ho` varchar(108) NOT NULL,
  `due_date` varchar(120) NOT NULL,
  `c_worker` varchar(120) NOT NULL,
  `h_wa_num` int(3) NOT NULL,
  `h_ca_num` int(3) NOT NULL,
  `tm_num` int(5) NOT NULL,
  `t_wa_num` int(3) NOT NULL,
  `t_ca_num` int(3) NOT NULL,
  `dm_sms_num` int(5) NOT NULL,
  `d_cust_name` varchar(120) NOT NULL,
  `d_content` varchar(680) NOT NULL,
  `d_worker` varchar(120) NOT NULL,
  `d_sale_act` tinytext NOT NULL,
  `n_cust_name` varchar(120) NOT NULL,
  `n_content` varchar(680) NOT NULL,
  `n_worker` varchar(120) NOT NULL,
  `n_sale_plan` tinytext NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `c_worker` (`c_worker`),
  KEY `n_worker` (`n_worker`),
  KEY `d_worker` (`d_worker`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

";

////////////////////////////////////////////////////////////////////////////
// 29. 업무보고 기록
///////////////////////////////////////////////////////////////////////////

$work_rep_tb_schema = "

CREATE TABLE IF NOT EXISTS `$work_rep_tb` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

";


////////////////////////////////////////////////////////////////////////////
// 30. 우편번호 디비
///////////////////////////////////////////////////////////////////////////

$zipcode_tb_schema = "

CREATE TABLE IF NOT EXISTS `$zipcode_tb` (
  `seq` int(6) NOT NULL,
  `zipcode` varchar(8) NOT NULL,
  `sido` varchar(10) NOT NULL DEFAULT '',
  `gugun` varchar(17) NOT NULL DEFAULT '',
  `dong` varchar(76) NOT NULL,
  `bunji` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`seq`),
  UNIQUE KEY `zipcode` (`zipcode`),
  KEY `sido` (`sido`,`gugun`,`dong`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='우편변호 정보 - 2013년 4월';

";