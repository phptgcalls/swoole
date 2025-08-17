<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name string native_name string lang_code string plural_code int strings_count int translated_count string translations_url true official true rtl true beta string base_lang_code
 * @return LangPackLanguage
 */

final class LangPackLanguage extends Instance {
	public function request(string $name,string $native_name,string $lang_code,string $plural_code,int $strings_count,int $translated_count,string $translations_url,? true $official = null,? true $rtl = null,? true $beta = null,? string $base_lang_code = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeeca5ce3);
		$flags = 0;
		$flags |= is_null($official) ? 0 : (1 << 0);
		$flags |= is_null($rtl) ? 0 : (1 << 2);
		$flags |= is_null($beta) ? 0 : (1 << 3);
		$flags |= is_null($base_lang_code) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($name);
		$writer->tgwriteBytes($native_name);
		$writer->tgwriteBytes($lang_code);
		if(is_null($base_lang_code) === false):
			$writer->tgwriteBytes($base_lang_code);
		endif;
		$writer->tgwriteBytes($plural_code);
		$writer->writeInt($strings_count);
		$writer->writeInt($translated_count);
		$writer->tgwriteBytes($translations_url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['official'] = true;
		else:
			$result['official'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['rtl'] = true;
		else:
			$result['rtl'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['beta'] = true;
		else:
			$result['beta'] = false;
		endif;
		$result['name'] = $reader->tgreadBytes();
		$result['native_name'] = $reader->tgreadBytes();
		$result['lang_code'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['base_lang_code'] = $reader->tgreadBytes();
		else:
			$result['base_lang_code'] = null;
		endif;
		$result['plural_code'] = $reader->tgreadBytes();
		$result['strings_count'] = $reader->readInt();
		$result['translated_count'] = $reader->readInt();
		$result['translations_url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>