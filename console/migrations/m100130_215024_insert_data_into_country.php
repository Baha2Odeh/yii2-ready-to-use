<?php

use yii\db\Migration;

/**
 * Handles the data insertion for table `{{%country}}`.
 */
class m100130_215024_insert_data_into_country extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
$this->batchInsert('{{%country}}', ['id','iso','name','printable_name','iso3','numcode','dialing_code_1','dialing_code_2','dialing_code_3','degree_language_id','weight','arabic_name','created_at','created_by','updated_at','updated_by','is_deleted','deleted_at','deleted_by','ip_address','user_agent'], [
			['1','AF','AFGHANISTAN','Afghanistan','AFG','4','93','','','3','0','أفغانستان','2019-01-30 23:26:49','','','','0','','','',''],
			['2','AL','ALBANIA','Albania','ALB','8','355','','','3','0','ألبانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['3','DZ','ALGERIA','Algeria','DZA','12','213','','','1','0','الجزائر','2019-01-30 23:26:49','','','','0','','','',''],
			['4','AS','AMERICAN SAMOA','American Samoa','ASM','16','1684','','','3','0','ساموا الأمريكية','2019-01-30 23:26:49','','','','0','','','',''],
			['5','AD','ANDORRA','Andorra','AND','20','376','','','3','0','أندورا','2019-01-30 23:26:49','','','','0','','','',''],
			['6','AO','ANGOLA','Angola','AGO','24','244','','','3','0','أنغولا','2019-01-30 23:26:49','','','','0','','','',''],
			['7','AI','ANGUILLA','Anguilla','AIA','660','1264','','','3','0','أنغيلا','2019-01-30 23:26:49','','','','0','','','',''],
			['8','AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG','28','1268','','','3','0','أنتيغوا و بربودا','2019-01-30 23:26:49','','','','0','','','',''],
			['9','AR','ARGENTINA','Argentina','ARG','32','54','','','3','0','الأرجنتين','2019-01-30 23:26:49','','','','0','','','',''],
			['10','AM','ARMENIA','Armenia','ARM','51','374','','','3','0','أرمينيا','2019-01-30 23:26:49','','','','0','','','',''],
			['11','AW','ARUBA','Aruba','ABW','533','297','','','3','0','أروبا','2019-01-30 23:26:49','','','','0','','','',''],
			['12','AU','AUSTRALIA','Australia','AUS','36','61','','','3','0','أستراليا','2019-01-30 23:26:49','','','','0','','','',''],
			['13','AT','AUSTRIA','Austria','AUT','40','43','','','3','0','النمسا','2019-01-30 23:26:49','','','','0','','','',''],
			['14','AZ','AZERBAIJAN','Azerbaijan','AZE','31','994','','','3','0','أذربيجان','2019-01-30 23:26:49','','','','0','','','',''],
			['15','BS','BAHAMAS','Bahamas','BHS','44','1242','','','3','0','جزر البهاما','2019-01-30 23:26:49','','','','0','','','',''],
			['16','BH','BAHRAIN','Bahrain','BHR','48','973','','','1','0','البحرين','2019-01-30 23:26:49','','','','0','','','',''],
			['17','BD','BANGLADESH','Bangladesh','BGD','50','880','','','3','0','بنغلاديش','2019-01-30 23:26:49','','','','0','','','',''],
			['18','BB','BARBADOS','Barbados','BRB','52','1246','','','3','0','بربادوس','2019-01-30 23:26:49','','','','0','','','',''],
			['19','BY','BELARUS','Belarus','BLR','112','375','','','3','0','روسيا البيضاء','2019-01-30 23:26:49','','','','0','','','',''],
			['20','BE','BELGIUM','Belgium','BEL','56','32','','','3','0','بلجيكا','2019-01-30 23:26:49','','','','0','','','',''],
			['21','BZ','BELIZE','Belize','BLZ','84','501','','','3','0','بليز','2019-01-30 23:26:49','','','','0','','','',''],
			['22','BJ','BENIN','Benin','BEN','204','229','','','3','0','بنين','2019-01-30 23:26:49','','','','0','','','',''],
			['23','BM','BERMUDA','Bermuda','BMU','60','1441','','','3','0','برمودا','2019-01-30 23:26:49','','','','0','','','',''],
			['24','BT','BHUTAN','Bhutan','BTN','64','975','','','3','0','بوتان','2019-01-30 23:26:49','','','','0','','','',''],
			['25','BO','BOLIVIA','Bolivia','BOL','68','591','','','3','0','بوليفيا','2019-01-30 23:26:49','','','','0','','','',''],
			['26','BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH','70','387','','','3','0','البوسنة و الهرسك','2019-01-30 23:26:49','','','','0','','','',''],
			['27','BW','BOTSWANA','Botswana','BWA','72','267','','','3','0','بوتسوانا','2019-01-30 23:26:49','','','','0','','','',''],
			['28','BR','BRAZIL','Brazil','BRA','76','55','','','7','0','البرازيل','2019-01-30 23:26:49','','','','0','','','',''],
			['29','BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN','96','673','','','3','0','بروناي دار السلام','2019-01-30 23:26:49','','','','0','','','',''],
			['30','BG','BULGARIA','Bulgaria','BGR','100','359','','','3','0','بلغاريا','2019-01-30 23:26:49','','','','0','','','',''],
			['31','BF','BURKINA FASO','Burkina Faso','BFA','854','226','','','3','0','بوركينا فاسو','2019-01-30 23:26:49','','','','0','','','',''],
			['32','BI','BURUNDI','Burundi','BDI','108','257','','','3','0','بوروندي','2019-01-30 23:26:49','','','','0','','','',''],
			['33','KH','CAMBODIA','Cambodia','KHM','116','855','','','3','0','كمبوديا','2019-01-30 23:26:49','','','','0','','','',''],
			['34','CM','CAMEROON','Cameroon','CMR','120','237','','','3','0','الكاميرون','2019-01-30 23:26:49','','','','0','','','',''],
			['35','CA','CANADA','Canada','CAN','124','1','','','3','0','كندا','2019-01-30 23:26:49','','','','0','','','',''],
			['36','CV','CAPE VERDE','Cape Verde','CPV','132','238','','','3','0','الرأس الأخضر','2019-01-30 23:26:49','','','','0','','','',''],
			['37','KY','CAYMAN ISLANDS','Cayman Islands','CYM','136','1345','','','3','0','جزر كايمان','2019-01-30 23:26:49','','','','0','','','',''],
			['38','CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF','140','236','','','3','0','جمهورية أفريقيا الوسطى','2019-01-30 23:26:49','','','','0','','','',''],
			['39','TD','CHAD','Chad','TCD','148','235','','','3','0','تشاد','2019-01-30 23:26:49','','','','0','','','',''],
			['40','CL','CHILE','Chile','CHL','152','56','','','3','0','تشيلي','2019-01-30 23:26:49','','','','0','','','',''],
			['41','CN','CHINA','China','CHN','156','86','','','2','0','الصين','2019-01-30 23:26:49','','','','0','','','',''],
			['42','CO','COLOMBIA','Colombia','COL','170','57','','','3','0','كولومبيا','2019-01-30 23:26:49','','','','0','','','',''],
			['43','KM','COMOROS','Comoros','COM','174','269','','','3','0','جزر القمر','2019-01-30 23:26:49','','','','0','','','',''],
			['44','CG','CONGO','Congo','COG','178','242','','','3','0','الكونغو','2019-01-30 23:26:49','','','','0','','','',''],
			['45','CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD','180','243','','','3','0','جمهورية الكونغو الديمقراطية','2019-01-30 23:26:49','','','','0','','','',''],
			['46','CK','COOK ISLANDS','Cook Islands','COK','184','682','','','3','0','جزر كوك','2019-01-30 23:26:49','','','','0','','','',''],
			['47','CR','COSTA RICA','Costa Rica','CRI','188','506','','','3','0','كوستاريكا','2019-01-30 23:26:49','','','','0','','','',''],
			['48','CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV','384','225','','','3','0','ساحل العاج','2019-01-30 23:26:49','','','','0','','','',''],
			['49','HR','CROATIA','Croatia','HRV','191','385','','','3','0','كرواتيا','2019-01-30 23:26:49','','','','0','','','',''],
			['50','CU','CUBA','Cuba','CUB','192','53','','','3','0','كوبا','2019-01-30 23:26:49','','','','0','','','',''],
			['51','CY','CYPRUS','Cyprus','CYP','196','357','','','3','0','قبرص','2019-01-30 23:26:49','','','','0','','','',''],
			['52','CZ','CZECH REPUBLIC','Czech Republic','CZE','203','420','','','3','0','جمهورية التشيك','2019-01-30 23:26:49','','','','0','','','',''],
			['53','DK','DENMARK','Denmark','DNK','208','45','','','3','0','الدنمارك','2019-01-30 23:26:49','','','','0','','','',''],
			['54','DJ','DJIBOUTI','Djibouti','DJI','262','253','','','3','0','جيبوتي','2019-01-30 23:26:49','','','','0','','','',''],
			['55','DM','DOMINICA','Dominica','DMA','212','1767','','','3','0','دومينيكا','2019-01-30 23:26:49','','','','0','','','',''],
			['56','DO','DOMINICAN REPUBLIC','Dominican Republic','DOM','214','1809','1829','1849','3','0','جمهورية الدومينيكان','2019-01-30 23:26:49','','','','0','','','',''],
			['57','EC','ECUADOR','Ecuador','ECU','218','593','','','3','0','الاكوادور','2019-01-30 23:26:49','','','','0','','','',''],
			['58','EG','EGYPT','Egypt','EGY','818','20','','','1','0','مصر','2019-01-30 23:26:49','','','','0','','','',''],
			['59','SV','EL SALVADOR','El Salvador','SLV','222','503','','','3','0','السلفادور','2019-01-30 23:26:49','','','','0','','','',''],
			['60','GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ','226','240','','','3','0','غينيا الاستوائية','2019-01-30 23:26:49','','','','0','','','',''],
			['61','ER','ERITREA','Eritrea','ERI','232','291','','','3','0','إريتريا','2019-01-30 23:26:49','','','','0','','','',''],
			['62','EE','ESTONIA','Estonia','EST','233','372','','','3','0','استونيا','2019-01-30 23:26:49','','','','0','','','',''],
			['63','ET','ETHIOPIA','Ethiopia','ETH','231','251','','','3','0','أثيوبيا','2019-01-30 23:26:49','','','','0','','','',''],
			['64','FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK','238','500','','','3','0','جزر فوكلاند ( مالفيناس )','2019-01-30 23:26:49','','','','0','','','',''],
			['65','FO','FAROE ISLANDS','Faroe Islands','FRO','234','298','','','3','0','جزر فارو','2019-01-30 23:26:49','','','','0','','','',''],
			['66','FJ','FIJI','Fiji','FJI','242','679','','','3','0','فيجي','2019-01-30 23:26:49','','','','0','','','',''],
			['67','FI','FINLAND','Finland','FIN','246','358','','','3','0','فنلندا','2019-01-30 23:26:49','','','','0','','','',''],
			['68','FR','FRANCE','France','FRA','250','33','','','4','0','فرنسا','2019-01-30 23:26:49','','','','0','','','',''],
			['69','GF','FRENCH GUIANA','French Guiana','GUF','254','594','','','3','0','جويانا الفرنسية','2019-01-30 23:26:49','','','','0','','','',''],
			['70','PF','FRENCH POLYNESIA','French Polynesia','PYF','258','689','','','3','0','بولينيزيا الفرنسية','2019-01-30 23:26:49','','','','0','','','',''],
			['71','GA','GABON','Gabon','GAB','266','241','','','3','0','الغابون','2019-01-30 23:26:49','','','','0','','','',''],
			['72','GM','GAMBIA','Gambia','GMB','270','220','','','3','0','غامبيا','2019-01-30 23:26:49','','','','0','','','',''],
			['73','GE','GEORGIA','Georgia','GEO','268','995','','','3','0','جورجيا','2019-01-30 23:26:49','','','','0','','','',''],
			['74','DE','GERMANY','Germany','DEU','276','49','','','5','0','المانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['75','GH','GHANA','Ghana','GHA','288','233','','','3','0','غانا','2019-01-30 23:26:49','','','','0','','','',''],
			['76','GI','GIBRALTAR','Gibraltar','GIB','292','350','','','3','0','جبل طارق','2019-01-30 23:26:49','','','','0','','','',''],
			['77','GR','GREECE','Greece','GRC','300','30','','','3','0','يونان','2019-01-30 23:26:49','','','','0','','','',''],
			['78','GL','GREENLAND','Greenland','GRL','304','299','','','3','0','جرينلاند','2019-01-30 23:26:49','','','','0','','','',''],
			['79','GD','GRENADA','Grenada','GRD','308','1473','','','3','0','غرينادا','2019-01-30 23:26:49','','','','0','','','',''],
			['80','GP','GUADELOUPE','Guadeloupe','GLP','312','590','','','3','0','غوادلوب','2019-01-30 23:26:49','','','','0','','','',''],
			['81','GU','GUAM','Guam','GUM','316','1671','','','3','0','غوام','2019-01-30 23:26:49','','','','0','','','',''],
			['82','GT','GUATEMALA','Guatemala','GTM','320','502','','','3','0','غواتيمالا','2019-01-30 23:26:49','','','','0','','','',''],
			['83','GN','GUINEA','Guinea','GIN','324','224','','','3','0','غينيا','2019-01-30 23:26:49','','','','0','','','',''],
			['84','GW','GUINEA-BISSAU','Guinea-Bissau','GNB','624','245','','','3','0','غينيا بيساو','2019-01-30 23:26:49','','','','0','','','',''],
			['85','GY','GUYANA','Guyana','GUY','328','592','','','3','0','غيانا','2019-01-30 23:26:49','','','','0','','','',''],
			['86','HT','HAITI','Haiti','HTI','332','509','','','3','0','هايتي','2019-01-30 23:26:49','','','','0','','','',''],
			['87','VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT','336','39','','','3','0','الكرسي الرسولي (دولة الفاتيكان )','2019-01-30 23:26:49','','','','0','','','',''],
			['88','HN','HONDURAS','Honduras','HND','340','504','','','3','0','هندوراس','2019-01-30 23:26:49','','','','0','','','',''],
			['89','HK','HONG KONG','Hong Kong','HKG','344','852','','','3','0','هونغ كونغ','2019-01-30 23:26:49','','','','0','','','',''],
			['90','HU','HUNGARY','Hungary','HUN','348','36','','','3','0','هنغاريا','2019-01-30 23:26:49','','','','0','','','',''],
			['91','IS','ICELAND','Iceland','ISL','352','354','','','3','0','أيسلندا','2019-01-30 23:26:49','','','','0','','','',''],
			['92','IN','INDIA','India','IND','356','91','','','3','0','الهند','2019-01-30 23:26:49','','','','0','','','',''],
			['93','ID','INDONESIA','Indonesia','IDN','360','62','','','3','0','أندونيسيا','2019-01-30 23:26:49','','','','0','','','',''],
			['94','IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN','364','98','','','3','0','جمهورية إيران الإسلامية','2019-01-30 23:26:49','','','','0','','','',''],
			['95','IQ','IRAQ','Iraq','IRQ','368','964','','','1','0','العراق','2019-01-30 23:26:49','','','','0','','','',''],
			['96','IE','IRELAND','Ireland','IRL','372','353','','','3','0','أيرلندا','2019-01-30 23:26:49','','','','0','','','',''],
			['97','IT','ITALY','Italy','ITA','380','39','','','3','0','إيطاليا','2019-01-30 23:26:49','','','','0','','','',''],
			['98','JM','JAMAICA','Jamaica','JAM','388','1876','','','3','0','جامايكا','2019-01-30 23:26:49','','','','0','','','',''],
			['99','JP','JAPAN','Japan','JPN','392','81','','','6','0','اليابان','2019-01-30 23:26:49','','','','0','','','',''],
			['100','JO','JORDAN','Jordan','JOR','400','962','','','1','0','الاردن','2019-01-30 23:26:49','','','','0','','','',''],
			['101','KZ','KAZAKHSTAN','Kazakhstan','KAZ','398','76','77','','3','0','كازاخستان','2019-01-30 23:26:49','','','','0','','','',''],
			['102','KE','KENYA','Kenya','KEN','404','254','','','3','0','كينيا','2019-01-30 23:26:49','','','','0','','','',''],
			['103','KI','KIRIBATI','Kiribati','KIR','296','686','','','3','0','كيريباتي','2019-01-30 23:26:49','','','','0','','','',''],
			['104','KP','North Korea','Korea, Democratic People\'s Republic of','PRK','408','850','','','3','0','جمهورية كوريا الشعبية الديمقراطية','2019-01-30 23:26:49','','','','0','','','',''],
			['105','KR','South Korea','South Korea','KOR','410','82','','','3','0','كوريا الجنوبية','2019-01-30 23:26:49','','','','0','','','',''],
			['106','KW','KUWAIT','Kuwait','KWT','414','965','','','1','0','الكويت','2019-01-30 23:26:49','','','','0','','','',''],
			['107','KG','KYRGYZSTAN','Kyrgyzstan','KGZ','417','996','','','3','0','قرغيزستان','2019-01-30 23:26:49','','','','0','','','',''],
			['108','LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO','418','856','','','3','0','جمهورية لاو الديمقراطية الشعبية','2019-01-30 23:26:49','','','','0','','','',''],
			['109','LV','LATVIA','Latvia','LVA','428','371','','','3','0','لاتفيا','2019-01-30 23:26:49','','','','0','','','',''],
			['110','LB','LEBANON','Lebanon','LBN','422','961','','','1','0','لبنان','2019-01-30 23:26:49','','','','0','','','',''],
			['111','LS','LESOTHO','Lesotho','LSO','426','266','','','3','0','ليسوتو','2019-01-30 23:26:49','','','','0','','','',''],
			['112','LR','LIBERIA','Liberia','LBR','430','231','','','3','0','ليبيريا','2019-01-30 23:26:49','','','','0','','','',''],
			['113','LY','LIBYA','Libyan Arab Jamahiriya','LBY','434','218','','','1','0','الجماهيرية العربية الليبية','2019-01-30 23:26:49','','','','0','','','',''],
			['114','LI','LIECHTENSTEIN','Liechtenstein','LIE','438','423','','','3','0','ليختنشتاين','2019-01-30 23:26:49','','','','0','','','',''],
			['115','LT','LITHUANIA','Lithuania','LTU','440','370','','','3','0','ليتوانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['116','LU','LUXEMBOURG','Luxembourg','LUX','442','352','','','3','0','لوكسمبورغ','2019-01-30 23:26:49','','','','0','','','',''],
			['117','MO','MACAO','Macao','MAC','446','853','','','3','0','ماكاو','2019-01-30 23:26:49','','','','0','','','',''],
			['118','MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD','807','389','','','3','0','مقدونيا، الجمهورية اليوغوسلافية السابقة','2019-01-30 23:26:49','','','','0','','','',''],
			['119','MG','MADAGASCAR','Madagascar','MDG','450','261','','','3','0','مدغشقر','2019-01-30 23:26:49','','','','0','','','',''],
			['120','MW','MALAWI','Malawi','MWI','454','265','','','3','0','ملاوي','2019-01-30 23:26:49','','','','0','','','',''],
			['121','MY','MALAYSIA','Malaysia','MYS','458','60','','','3','0','ماليزيا','2019-01-30 23:26:49','','','','0','','','',''],
			['122','MV','MALDIVES','Maldives','MDV','462','960','','','3','0','جزر المالديف','2019-01-30 23:26:49','','','','0','','','',''],
			['123','ML','MALI','Mali','MLI','466','223','','','3','0','مالي','2019-01-30 23:26:49','','','','0','','','',''],
			['124','MT','MALTA','Malta','MLT','470','356','','','3','0','مالطا','2019-01-30 23:26:49','','','','0','','','',''],
			['125','MH','MARSHALL ISLANDS','Marshall Islands','MHL','584','692','','','3','0','جزر مارشال','2019-01-30 23:26:49','','','','0','','','',''],
			['126','MQ','MARTINIQUE','Martinique','MTQ','474','596','','','3','0','مارتينيك','2019-01-30 23:26:49','','','','0','','','',''],
			['127','MR','MAURITANIA','Mauritania','MRT','478','222','','','3','0','موريتانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['128','MU','MAURITIUS','Mauritius','MUS','480','230','','','3','0','موريشيوس','2019-01-30 23:26:49','','','','0','','','',''],
			['129','MX','MEXICO','Mexico','MEX','484','52','','','3','0','المكسيك','2019-01-30 23:26:49','','','','0','','','',''],
			['130','FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM','583','691','','','3','0','ولايات ميكرونيزيا الموحدة','2019-01-30 23:26:49','','','','0','','','',''],
			['131','MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA','498','373','','','3','0','جمهورية مولدوفا','2019-01-30 23:26:49','','','','0','','','',''],
			['132','MC','MONACO','Monaco','MCO','492','377','','','3','0','موناكو','2019-01-30 23:26:49','','','','0','','','',''],
			['133','MN','MONGOLIA','Mongolia','MNG','496','976','','','3','0','منغوليا','2019-01-30 23:26:49','','','','0','','','',''],
			['134','MS','MONTSERRAT','Montserrat','MSR','500','1664','','','3','0','مونتسيرات','2019-01-30 23:26:49','','','','0','','','',''],
			['135','MA','MOROCCO','Morocco','MAR','504','212','','','1','0','مغربي','2019-01-30 23:26:49','','','','0','','','',''],
			['136','MZ','MOZAMBIQUE','Mozambique','MOZ','508','258','','','3','0','موزمبيق','2019-01-30 23:26:49','','','','0','','','',''],
			['137','MM','MYANMAR','Myanmar','MMR','104','95','','','3','0','ميانمار','2019-01-30 23:26:49','','','','0','','','',''],
			['138','NA','NAMIBIA','Namibia','NAM','516','264','','','3','0','ناميبيا','2019-01-30 23:26:49','','','','0','','','',''],
			['139','NR','NAURU','Nauru','NRU','520','674','','','3','0','ناورو','2019-01-30 23:26:49','','','','0','','','',''],
			['140','NP','NEPAL','Nepal','NPL','524','977','','','3','0','نيبال','2019-01-30 23:26:49','','','','0','','','',''],
			['141','NL','NETHERLANDS','Netherlands','NLD','528','31','','','3','0','هولندا','2019-01-30 23:26:49','','','','0','','','',''],
			['142','AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT','530','599','','','3','0','جزر الأنتيل الهولندية','2019-01-30 23:26:49','','','','0','','','',''],
			['143','NC','NEW CALEDONIA','New Caledonia','NCL','540','687','','','3','0','كاليدونيا الجديدة','2019-01-30 23:26:49','','','','0','','','',''],
			['144','NZ','NEW ZEALAND','New Zealand','NZL','554','64','','','3','0','نيوزيلندا','2019-01-30 23:26:49','','','','0','','','',''],
			['145','NI','NICARAGUA','Nicaragua','NIC','558','505','','','3','0','نيكاراغوا','2019-01-30 23:26:49','','','','0','','','',''],
			['146','NE','NIGER','Niger','NER','562','227','','','3','0','النيجر','2019-01-30 23:26:49','','','','0','','','',''],
			['147','NG','NIGERIA','Nigeria','NGA','566','234','','','3','0','نيجيريا','2019-01-30 23:26:49','','','','0','','','',''],
			['148','NU','NIUE','Niue','NIU','570','683','','','3','0','نيوي','2019-01-30 23:26:49','','','','0','','','',''],
			['149','NF','NORFOLK ISLAND','Norfolk Island','NFK','574','672','','','3','0','جزيرة نورفولك','2019-01-30 23:26:49','','','','0','','','',''],
			['150','MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP','580','1670','','','3','0','جزر ماريانا الشمالية','2019-01-30 23:26:49','','','','0','','','',''],
			['151','NO','NORWAY','Norway','NOR','578','47','','','3','0','النرويج','2019-01-30 23:26:49','','','','0','','','',''],
			['152','OM','OMAN','Oman','OMN','512','968','','','1','0','عمان','2019-01-30 23:26:49','','','','0','','','',''],
			['153','PK','PAKISTAN','Pakistan','PAK','586','92','','','3','0','باكستان','2019-01-30 23:26:49','','','','0','','','',''],
			['154','PW','PALAU','Palau','PLW','585','680','','','3','0','بالاو','2019-01-30 23:26:49','','','','0','','','',''],
			['155','PS','PALESTINE','Palestine','PSE','275','970','','','1','0','فلسطين','2019-01-30 23:26:49','','','','0','','','',''],
			['156','PA','PANAMA','Panama','PAN','591','507','','','3','0','بناما','2019-01-30 23:26:49','','','','0','','','',''],
			['157','PG','PAPUA NEW GUINEA','Papua New Guinea','PNG','598','675','','','3','0','بابوا غينيا الجديدة','2019-01-30 23:26:49','','','','0','','','',''],
			['158','PY','PARAGUAY','Paraguay','PRY','600','595','','','3','0','باراغواي','2019-01-30 23:26:49','','','','0','','','',''],
			['159','PE','PERU','Peru','PER','604','51','','','3','0','بيرو','2019-01-30 23:26:49','','','','0','','','',''],
			['160','PH','PHILIPPINES','Philippines','PHL','608','63','','','3','0','الفلبين','2019-01-30 23:26:49','','','','0','','','',''],
			['161','PN','PITCAIRN','Pitcairn','PCN','612','','','','3','0','بيتكيرن','2019-01-30 23:26:49','','','','0','','','',''],
			['162','PL','POLAND','Poland','POL','616','48','','','3','0','بولندا','2019-01-30 23:26:49','','','','0','','','',''],
			['163','PT','PORTUGAL','Portugal','PRT','620','351','','','3','0','البرتغال','2019-01-30 23:26:49','','','','0','','','',''],
			['164','PR','PUERTO RICO','Puerto Rico','PRI','630','1787','1939','','3','0','بورتوريكو','2019-01-30 23:26:49','','','','0','','','',''],
			['165','QA','QATAR','Qatar','QAT','634','974','','','1','0','قطر','2019-01-30 23:26:49','','','','0','','','',''],
			['166','RE','REUNION','Reunion','REU','638','','','','3','0','جمع شمل','2019-01-30 23:26:49','','','','0','','','',''],
			['167','RO','ROMANIA','Romania','ROM','642','40','','','3','0','رومانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['168','RU','RUSSIAN FEDERATION','Russian Federation','RUS','643','7','','','3','0','الاتحاد الروسي','2019-01-30 23:26:49','','','','0','','','',''],
			['169','RW','RWANDA','Rwanda','RWA','646','250','','','3','0','رواندا','2019-01-30 23:26:49','','','','0','','','',''],
			['170','SH','SAINT HELENA','Saint Helena','SHN','654','290','','','3','0','سانت هيلينا','2019-01-30 23:26:49','','','','0','','','',''],
			['171','KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA','659','1869','','','3','0','سانت كيتس و نيفيس','2019-01-30 23:26:49','','','','0','','','',''],
			['172','LC','SAINT LUCIA','Saint Lucia','LCA','662','1758','','','3','0','سانت لوسيا','2019-01-30 23:26:49','','','','0','','','',''],
			['173','PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM','666','508','','','3','0','سان بيار و ميكلون','2019-01-30 23:26:49','','','','0','','','',''],
			['174','VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT','670','1784','','','3','0','سانت فنسنت وجزر غرينادين','2019-01-30 23:26:49','','','','0','','','',''],
			['175','WS','SAMOA','Samoa','WSM','882','685','','','3','0','ساموا','2019-01-30 23:26:49','','','','0','','','',''],
			['176','SM','SAN MARINO','San Marino','SMR','674','378','','','3','0','سان مارينو','2019-01-30 23:26:49','','','','0','','','',''],
			['177','ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP','678','239','','','3','0','ساو تومي و برينسيبي','2019-01-30 23:26:49','','','','0','','','',''],
			['178','SA','SAUDI ARABIA','Saudi Arabia','SAU','682','966','','','1','11','السعودية','2019-01-30 23:26:49','','','','0','','','',''],
			['179','SN','SENEGAL','Senegal','SEN','686','221','','','3','0','السنغال','2019-01-30 23:26:49','','','','0','','','',''],
			['180','SC','SEYCHELLES','Seychelles','SYC','690','248','','','3','0','سيشيل','2019-01-30 23:26:49','','','','0','','','',''],
			['181','SL','SIERRA LEONE','Sierra Leone','SLE','694','232','','','3','0','سيراليون','2019-01-30 23:26:49','','','','0','','','',''],
			['182','SG','SINGAPORE','Singapore','SGP','702','65','','','3','0','سنغافورة','2019-01-30 23:26:49','','','','0','','','',''],
			['183','SK','SLOVAKIA','Slovakia','SVK','703','421','','','3','0','سلوفاكيا','2019-01-30 23:26:49','','','','0','','','',''],
			['184','SI','SLOVENIA','Slovenia','SVN','705','386','','','3','0','سلوفينيا','2019-01-30 23:26:49','','','','0','','','',''],
			['185','SB','SOLOMON ISLANDS','Solomon Islands','SLB','90','677','','','3','0','جزر سليمان','2019-01-30 23:26:49','','','','0','','','',''],
			['186','SO','SOMALIA','Somalia','SOM','706','252','','','3','0','الصومال','2019-01-30 23:26:49','','','','0','','','',''],
			['187','ZA','SOUTH AFRICA','South Africa','ZAF','710','27','','','3','0','جنوب أفريقيا','2019-01-30 23:26:49','','','','0','','','',''],
			['188','ES','SPAIN','Spain','ESP','724','34','','','8','0','إسبانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['189','LK','SRI LANKA','Sri Lanka','LKA','144','94','','','3','0','سري ل انكا','2019-01-30 23:26:49','','','','0','','','',''],
			['190','SD','SUDAN','Sudan','SDN','736','249','','','1','0','سودان','2019-01-30 23:26:49','','','','0','','','',''],
			['191','SR','SURINAME','Suriname','SUR','740','597','','','3','0','سورينام','2019-01-30 23:26:49','','','','0','','','',''],
			['192','SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM','744','','','','3','0','سفالبارد','2019-01-30 23:26:49','','','','0','','','',''],
			['193','SZ','SWAZILAND','Swaziland','SWZ','748','268','','','3','0','سوازيلاند','2019-01-30 23:26:49','','','','0','','','',''],
			['194','SE','SWEDEN','Sweden','SWE','752','46','','','3','0','السويد','2019-01-30 23:26:49','','','','0','','','',''],
			['195','CH','SWITZERLAND','Switzerland','CHE','756','41','','','3','0','سويسرا','2019-01-30 23:26:49','','','','0','','','',''],
			['196','SY','SYRIA','Syria','SYR','760','963','','','1','0','سوريا','2019-01-30 23:26:49','','','','0','','','',''],
			['197','TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN','158','886','','','3','0','مقاطعة تايوان والصين','2019-01-30 23:26:49','','','','0','','','',''],
			['198','TJ','TAJIKISTAN','Tajikistan','TJK','762','992','','','3','0','طاجيكستان','2019-01-30 23:26:49','','','','0','','','',''],
			['199','TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA','834','255','','','3','0','جمهورية تنزانيا المتحدة','2019-01-30 23:26:49','','','','0','','','',''],
			['200','TH','THAILAND','Thailand','THA','764','66','','','3','0','تايلاند','2019-01-30 23:26:49','','','','0','','','',''],
			['201','TG','TOGO','Togo','TGO','768','228','','','3','0','توغو','2019-01-30 23:26:49','','','','0','','','',''],
			['202','TK','TOKELAU','Tokelau','TKL','772','690','','','3','0','توكيلاو','2019-01-30 23:26:49','','','','0','','','',''],
			['203','TO','TONGA','Tonga','TON','776','676','','','3','0','تونغا','2019-01-30 23:26:49','','','','0','','','',''],
			['204','TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO','780','1868','','','3','0','ترينيداد و توباغو','2019-01-30 23:26:49','','','','0','','','',''],
			['205','TN','TUNISIA','Tunisia','TUN','788','216','','','1','0','تونس','2019-01-30 23:26:49','','','','0','','','',''],
			['206','TR','TURKEY','Turkey','TUR','792','90','','','3','0','تركيا','2019-01-30 23:26:49','','','','0','','','',''],
			['207','TM','TURKMENISTAN','Turkmenistan','TKM','795','993','','','3','0','تركمانستان','2019-01-30 23:26:49','','','','0','','','',''],
			['208','TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA','796','1649','','','3','0','جزر تركس و كايكوس','2019-01-30 23:26:49','','','','0','','','',''],
			['209','TV','TUVALU','Tuvalu','TUV','798','688','','','3','0','توفالو','2019-01-30 23:26:49','','','','0','','','',''],
			['210','UG','UGANDA','Uganda','UGA','800','256','','','3','0','أوغندا','2019-01-30 23:26:49','','','','0','','','',''],
			['211','UA','UKRAINE','Ukraine','UKR','804','380','','','3','0','أوكرانيا','2019-01-30 23:26:49','','','','0','','','',''],
			['212','AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE','784','971','','','3','0','الإمارات العربية المتحدة','2019-01-30 23:26:49','','','','0','','','',''],
			['213','GB','UNITED KINGDOM','United Kingdom','GBR','826','44','','','3','0','المملكة المتحدة','2019-01-30 23:26:49','','','','0','','','',''],
			['214','US','UNITED STATES','United States','USA','840','1','','','3','0','الولايات المتحدة','2019-01-30 23:26:49','','','','0','','','',''],
			['215','UY','URUGUAY','Uruguay','URY','858','598','','','3','0','أوروغواي','2019-01-30 23:26:49','','','','0','','','',''],
			['216','UZ','UZBEKISTAN','Uzbekistan','UZB','860','998','','','3','0','أوزبكستان','2019-01-30 23:26:49','','','','0','','','',''],
			['217','VU','VANUATU','Vanuatu','VUT','548','678','','','3','0','فانواتو','2019-01-30 23:26:49','','','','0','','','',''],
			['218','VE','VENEZUELA','Venezuela','VEN','862','58','','','3','0','فنزويلا','2019-01-30 23:26:49','','','','0','','','',''],
			['219','VN','VIET NAM','Viet Nam','VNM','704','84','','','3','0','فييت نام','2019-01-30 23:26:49','','','','0','','','',''],
			['220','VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB','92','1284','','','3','0','جزر العذراء البريطانية','2019-01-30 23:26:49','','','','0','','','',''],
			['221','VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR','850','1340','','','3','0','جزر العذراء الأميركية','2019-01-30 23:26:49','','','','0','','','',''],
			['222','WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF','876','681','','','3','0','واليس وفوتونا','2019-01-30 23:26:49','','','','0','','','',''],
			['223','EH','WESTERN SAHARA','Western Sahara','ESH','732','','','','3','0','الصحراء الغربية','2019-01-30 23:26:49','','','','0','','','',''],
			['224','YE','YEMEN','Yemen','YEM','887','967','','','1','0','اليمن','2019-01-30 23:26:49','','','','0','','','',''],
			['225','ZM','ZAMBIA','Zambia','ZMB','894','260','','','3','0','زامبيا','2019-01-30 23:26:49','','','','0','','','',''],
			['226','ZW','ZIMBABWE','Zimbabwe','ZWE','716','263','','','3','0','زيمبابوي','2019-01-30 23:26:49','','','','0','','','',''],
			['227','','Other','','','','','','','','0','','2019-01-30 23:26:49','','','','0','','','','']]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
               
$this->truncateTable('{{%country}}');
    }
}
